<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Project;
use App\Models\Plan;
use App\Models\Option;
use App\Models\UserPlanCheering;
use Tests\TestCase;
use App\Actions\PayPay\PayPay;
use App\Actions\PayJp\PayJp;
use App\Actions\PayPay\PayPayInterface;
use App\Actions\PayJp\PayJpInterface;
use Illuminate\Http\Request;
use App\Traits\UniqueToken;
use Illuminate\Http\UploadedFile;

class PlanControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->project = Project::factory()
        ->state(
            [
                'talent_id' => 1,
                'title' => 'test title',
                'explanation' => 'test explanation',
                'release_status' => '掲載中',
                'start_date' => now(),
                'end_date' => now(),
                'target_amount' => 100000
            ]
        )->create();

        $this->plan = Plan::factory()
        ->state([
            'project_id' => $this->project->id,
            'title' => 'test title',
            'content' => 'test content',
            'image_url' => UploadedFile::fake()->image('test_image_first.jpg')->name,
            'necessary_address' => false,
        ])->create();

        $this->option = Option::factory()
        ->state([
            'plan_id' => $this->plan->id,
            'name' => 'test name',
            'quantity' => 10
        ])->create();

        $this->unique_token = UniqueToken::getToken();

        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret_for_test'));
        $params = [
            'card' => [
                "number" => "4242424242424242",
                "exp_month" => "12",
                "exp_year" => "2024",
            ]
        ];
        $this->payjp_token = \Payjp\Token::create($params, $options = ['payjp_direct_token_generate' => 'true']);

        $this->user_plan_cheering = UserPlanCheering::create([
            'user_id' => $this->user->id,
            'plan_id' => $this->plan->id,
            'address_id' => 1,
            'phone_number' => '000-0000-0000',
            'message_status' => 'ステータスなし',
            'selected_option' => $this->option->name,
            'merchant_payment_id' => $this->unique_token,
            'payment_is_finished' => false
        ]);

        $this->url = "project/{$this->project->id}/plan/{$this->plan->id}/address";

        $method = "POST";

        $this->request = Request::create($this->url, $method);

    }
    /**
     *
     * @param $result
     */
    public function testAddressConfirmActionIsSuccess()
    {
        $this->withoutExceptionHandling();
        $mock = \Mockery::mock(PayPay::class);
        $mock->shouldReceive('createQrCode')
                    ->once()
                    ->andReturn(
                    [
                        "resultInfo" => [
                            "code" => "SUCCESS",
                            "message" => "Success",
                            "codeId" => "08100001"
                        ],
                        "data" => [
                            "codeId" => "04-bwjnutWRauIiEJRz",
                            "url" => "https://qr-stg.sandbox.paypay.ne.jp/28180104bwjnutWRauIiEJRz",
                            "expiryDate" => 1623299844,
                            "merchantPaymentId" => "60c195d7395496.27275559",
                            "amount" => [
                            "amount" => 2000,
                            "currency" => "JPY"
                            ],
                        "codeType" => "ORDER_QR",
                            "requestedAt" => 1623299543,
                            "redirectUrl" => "http://localhost/project/27/plan/73/join",
                            "redirectType" => "WEB_LINK",
                            "isAuthorization" => false,
                            "deeplink" => "paypay://payment?link_key=https%3A%2F%2Fqr-stg.sandbox.paypay.ne.jp%2F28180104bwjnutWRauIiEJRz"
                        ]
                    ]);

            $this->app->bind(PayPayInterface::class, function() use ($mock){
                return $mock;
            });

        $response = $this->actingAs($this->user)
                        ->from($this->url)
                        ->post(route('user.plan.address.confirm',
                        [
                            'project' => $this->project,
                            'plan' => $this->plan,
                            'selected_option' => $this->option->name,
                            "settlement" => "settlement"
                        ]
                    ));

        $response->assertOk();
    }

    /**
     *
     * @param $result
     */
    public function testAddressConfirmActionIsFail()
    {
        $this->withoutExceptionHandling();
        $mock = \Mockery::mock(PayPay::class);
        $mock->shouldReceive('createQrCode')
                    ->once()
                    ->andReturn(
                    [
                        "resultInfo" => [
                            "code" => 'ERROR MESSAGE FROM TESTING ENV',
                            "message" => 'Error Message From Testing Env',
                            "codeId" => 'error message from testing env']
                    ])->getMock();

        $this->app->bind(PayPayInterface::class, function() use ($mock){
            return $mock;
        });

        $response = $this->actingAs($this->user)
                        ->from($this->url)
                        ->post(route('user.plan.address.confirm',
                        [
                            'project' => $this->project,
                            'plan' => $this->plan,
                            'selected_option' => $this->option->name,
                            "settlement" => "settlement"
                        ]
                    ));

        $response->assertRedirect(route('user.plan.address.confirm', ['project' => $this->project, 'plan' => $this->plan]));
    }
    /**
     * Test of PayJp should return charge instance
     *
     */
    public function testPaymentMethodOfPayJpClassShouldReturnResponse()
    {
        $this->withoutExceptionHandling();
        $mock = \Mockery::mock(PayJp::class);
        $mock->shouldReceive('Payment')
                ->withArgs([
                    \Mockery::any(),
                    \Mockery::any()
                ])
                ->andReturnUsing(function(){
                    \Payjp\Payjp::setApiKey(config('app.pay_jp_secret_for_test'));
                    $charge = new \Payjp\Charge();
                    $charge->id = 'test id';
                    return $charge;
                })
                ->getMock();

        $this->app->bind(PayJpInterface::class, function() use ($mock){
            return $mock;
        });

        $response = $this->actingAs($this->user)
        ->from($this->url)
        ->get(route('user.plan.join_for_payjp',
            [
                'project' => $this->project,
                'plan' => $this->plan,
                '_token' => csrf_token(),
                "payjp-token" => $this->payjp_token,
                'unique_token' => $this->unique_token
            ]
        ));

        $response->assertRedirect(route('user.plan.success', ['project' => $this->project, 'plan' => $this->plan]));
        $user_plan_cheering = UserPlanCheering::where('merchant_payment_id', $this->unique_token)->get();
        $this->assertCount(1, $user_plan_cheering);
        $this->assertSame('test id', $user_plan_cheering->first()->pay_jp_id);
    }

    /**
     * Test to fetch detail of pay pay payment details
     *
     */
    public function testCheckPayPayPaymentIsFinished()
    {
        $this->withoutExceptionHandling();
        $mock = \Mockery::mock(PayPay::class);
        $mock->shouldReceive('getPaymentDetail')
            ->with($this->unique_token)
            ->once()
            ->andReturn(
                [
                "resultInfo" => [
                    "code" => "SUCCESS",
                    "message" => "Success",
                    "codeId" => "08100001"
                ],
                "data" => [
                    "paymentId" => '12345678',
                    "status" => "COMPLETED",
                    "acceptedAt" => 1623728707,
                    "refunds" => [],
                    "merchantPaymentId" => $this->unique_token,
                    "amount" => [],
                    "requestedAt" => 1623728707,
                    "storeId" => "",
                    "terminalId" => "",
                    "orderItems" => []
                ]
            ])->getMock();

        $this->app->bind(PayPayInterface::class, function() use ($mock){
            return $mock;
        });

        $response = $this->actingAs($this->user)
            ->from(route('user.plan.select_payment',
                            [
                                'project' => $this->project,
                                'plan' => $this->plan,
                                'unique_token' => $this->unique_token
                            ])
                        )->get(route('user.plan.join_for_paypay',
                            [
                                'project' => $this->project,
                                'plan' => $this->plan,
                                'unique_token' => $this->unique_token
                            ])
                        );

        $response->assertRedirect(route('user.plan.success', ['project' => $this->project, 'plan' => $this->plan]));
        $user_plan_cheering = UserPlanCheering::where('merchant_payment_id', $this->unique_token)->where('payment_is_finished', true)->get();
        $this->assertCount(1, $user_plan_cheering);
        $this->assertSame($this->unique_token, $user_plan_cheering->first()->merchant_payment_id);
    }
}
