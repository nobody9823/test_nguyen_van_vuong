<?php

namespace Tests\Feature\User;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Plan;
use App\Models\ProjectFile;
use App\Models\User;
use App\Actions\PayPay\PayPay;
use App\Actions\PayPay\PayPayInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory()
            ->has(Profile::factory())
            ->has(
                Project::factory()->released()
                    ->has(
                        ProjectFile::factory()->state([
                            'file_url' => 'public/sampleImage/now_printing.png',
                            'file_content_type' => 'image_url',
                        ])
                    )
                    ->has(
                        Plan::factory()->state([
                            'price' => 1000
                        ])
                    )
            )->count(10)->create();

        $this->user = User::first();

        $this->project = $this->user->projects()->first();

        $this->plan = $this->project->plans()->first();

        $this->data_for_credit = [
            'validated_request' => [
                "plan_ids" => [
                    0 => $this->plan->price
                ],
                "plans" => [
                    $this->plan->id => ['quantity' => "1"]
                ],
                "total_amount" => $this->plan->price,
                "payment_way" => "credit",
                "payment_method_id" => "tok_0cf9542f036d4b0c3b05cc78c406",
                "first_name" => "山田",
                "last_name" => "太郎",
                "first_name_kana" => "ヤマダ",
                "last_name_kana" => "タロウ",
                "email" => "test@valleyin.co.jp",
                "gender" => "男性",
                "phone_number" => "00000000000",
                "postal_code" => "0000000",
                "prefecture" => "東京都",
                "city" => "test city",
                "block" => "test block",
                "building" => "test building",
                "birth_year" => "2021",
                "birth_month" => "1",
                "birth_day" => "1",
                "birthday" => "2021-01-01",
            ]
        ];

        $this->data_for_paypay = [
            'validated_request' => [
                "plan_ids" => [
                    0 => $this->plan->price
                ],
                "plans" => [
                    $this->plan->id => ['quantity' => "1"]
                ],
                "total_amount" => $this->plan->price,
                "payment_way" => "paypay",
                "first_name" => "山田",
                "last_name" => "太郎",
                "first_name_kana" => "ヤマダ",
                "last_name_kana" => "タロウ",
                "email" => "test@valleyin.co.jp",
                "gender" => "男性",
                "phone_number" => "00000000000",
                "postal_code" => "0000000",
                "prefecture" => "東京都",
                "city" => "test city",
                "block" => "test block",
                "building" => "test building",
                "birth_year" => "2021",
                "birth_month" => "1",
                "birth_day" => "1",
                "birthday" => "2021-01-01",
            ]
        ];

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
    }

    public function testIndexAction()
    {
        $response = $this->get('/fanding');
        $response->assertOk();
    }

    public function testShowAction()
    {
        $response = $this->actingAs($this->users->first())
            ->get(route('user.project.show', ['project' => Project::first()]));
        $response->assertOk();
    }

    public function testSearchAction()
    {
        $response = $this->get(route('user.search'));
        $response->assertOk();
    }

    public function testPrepareForPaymentForCredit()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)
            ->get(route('user.plan.prepare_for_payment', array_merge(['project' => $this->project], $this->data_for_credit)));

        $response->assertRedirect(route('user.plan.payment_for_credit', ['project' => $this->project, 'payment_without_globalscope' => $this->user->payments()->withoutGlobalScopes()->first()]));
    }

    public function testPrepareForPaymentForPayPay()
    {
        $this->withoutExceptionHandling();
        $mock = \Mockery::mock(PayPay::class);
        $mock->shouldReceive('createQrCode')
            ->once()
            ->andReturn($this->response_create_qr_code);

        $this->app->bind(PayPayInterface::class, function () use ($mock) {
            return $mock;
        });
        $response = $this->actingAs($this->user)
            ->get(route('user.plan.prepare_for_payment', array_merge(['project' => $this->project], $this->data_for_paypay)));

        $response->assertRedirect('https://qr-stg.sandbox.paypay.ne.jp/28180104c6BFhmBN9MGwhLaz');
        $payments = $this->user->payments()->withoutGlobalScopes()->get();
        $this->assertCount(1, $payments);
    }
}
