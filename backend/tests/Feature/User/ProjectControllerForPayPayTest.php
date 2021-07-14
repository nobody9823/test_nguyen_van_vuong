<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Project;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\PaymentToken;
use App\Models\Profile;
use App\Models\Address;
use App\Actions\PayPay\PayPay;
use App\Actions\PayPay\PayPayInterface;
use App\Traits\UniqueToken;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Exception;

class ProjectControllerForPayPayTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->creator = User::factory()->hasProfile()->create();

        $this->supporter = User::factory()->hasProfile()->create();

        $this->project = Project::factory()->state([
            'user_id' => $this->creator->id,
            'title' => 'test title',
            'content' => 'test content',
            'target_amount' => 10000000,
            'release_status' => '掲載中',
            'curator' => 'test_curator',
            'start_date' => now(),
            'end_date' => now()
        ])->create();

        $this->supporter->each(function ($user) {
            $this->profile = $user->profile()->save(Profile::factory()->make());
            $this->profile = $user->address()->save(Address::factory()->make());
            $this->payment = $user->payments()->save(Payment::factory()->make());
            $this->payment_token = $this->payment->paymentToken()->save(PaymentToken::factory()->make());
        });

        $this->plan = Plan::factory()->state([
            'project_id' => $this->project->id,
            'image_url' => UploadedFile::fake()->image('test_image_first.jpg')->name,
            'title' => 'test title',
            'content' => 'test content',
            'price' => 10000,
            'delivery_date' => now(),
            'limit_of_supporters' => 50
        ])->create();

        $this->response_create_qr_code = [
            "resultInfo" => [
                "code" => "SUCCESS",
                "message" => "Success",
                "codeId" => "08100001",
            ],
            "data" => [
                "codeId" => "04-c6BFhmBN9MGwhLaz",
                "url" => "https://qr-stg.sandbox.paypay.ne.jp/28180104c6BFhmBN9MGwhLaz",
                "expiryDate" => 1625210079,
                "merchantPaymentId" => "60debbada44a60.77119558",
                "amount" => [],
                "codeType" => "ORDER_QR",
                "requestedAt" => 1625209777,
                "redirectUrl" => "http://localhost/project/29/plan/314/payment_for_pay_pay",
                "redirectType" => "WEB_LINK",
                "isAuthorization" => false,
                "deeplink" => "paypay://payment?link_key=https%3A%2F%2Fqr-stg.sandbox.paypay.ne.jp%2F28180104c6BFhmBN9MGwhLaz",
            ]
        ];

        $this->response_payment_detail = [
            "resultInfo" => [
            "code" => "SUCCESS",
            "message" => "Success",
            "codeId" => "08100001",
            ],
            "data" => [
                "paymentId" => "03659954981238005760",
                "status" => "COMPLETED",
                "acceptedAt" => 1625220437,
                "refunds" => [],
                "merchantPaymentId" => $this->payment->paymentToken->token,
                "amount" => [],
                "requestedAt" => 1625220437,
                "storeId" => "",
                "terminalId" => "",
                "orderItems" => []
            ]
        ];

        $this->params = [
        "_token" => "p2a6jKCe7pfX6VeZ7VL6UKWp4u1pMRHvMO6ZinIZ",
        "plan_ids" => [
            0 => "1000"
        ],
        "plans" => [
            $this->plan->id => "1"
        ],
        "total_amount" => "1000",
        "display_added_price" => null,
        "payment_way" => "paypay",
        "payjp_token" => null,
        "first_name" => "山田",
        "last_name" => "太郎",
        "first_name_kana" => "ヤマダ",
        "last_name_kana" => "タロウ",
        "email" => $this->supporter->email,
        "gender" => "男性",
        "phone_number" => "00000000000",
        "postal_code" => "0000000",
        "prefecture" => "東京都",
        "city" => "test city",
        "block" => "test block",
        "building" => "test building",
        "birth_year" => "2020",
        "birth_month" => "1",
        "birth_day" => "1",
        "remarks" => "test remarks",
        "comments" => "test comments",
        "birthday" => "1996-01-01",
        ];
    }

    /**
     * test of do payment as pay pay is true
     *
     * @return void
     */
    public function testPaymentForPayPayIsTrue()
    {
        $this->withoutExceptionHandling();
        $mock = \Mockery::mock(PayPay::class);
        $mock->shouldReceive('getPaymentDetail')
            ->once()
            ->andReturn($this->response_payment_detail);

        $this->app->bind(PayPayInterface::class, function () use ($mock) {
            return $mock;
        });
        $response = $this->actingAs($this->supporter)
            ->get(route('user.plan.payment_for_pay_pay', ['project' => $this->project, 'payment' => $this->payment]));
        $response->assertOk();
        $payment = $this->supporter->payments()->where('payment_is_finished', true)->get();
        $this->assertCount(1, $payment);
    }

    /**
     * test of payment as pay pay is fail
     *
     *@return void
     */
    public function testPaymentForPayPayIsFail()
    {
        $this->withoutExceptionHandling();
        $this->expectException(Exception::class);
        $mock = \Mockery::mock(PayPay::class);
        $mock->shouldReceive('getPaymentDetail')
            ->once()
            ->andThrow(Exception::class);

        $this->app->bind(PayPayInterface::class, function () use ($mock) {
            return $mock;
        });
        ($this->actingAs($this->supporter)
            ->get(route('user.plan.payment_for_pay_pay', ['project' => $this->project, 'payment' => $this->payment])))->execute(1);
        $payment = $this->supporter->payments()->where('payment_is_finished', true)->get();
        $this->assertCount(0, $payment);
    }
}
