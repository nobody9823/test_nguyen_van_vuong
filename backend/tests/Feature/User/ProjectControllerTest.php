<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Project;
use App\Models\Plan;
use App\Models\Payment;
use Tests\TestCase;
use App\Traits\UniqueToken;
use Illuminate\Http\UploadedFile;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->creator = User::factory()->create();

        $this->supporter = User::factory()->create();

        $this->project = Project::factory()->state([
            'user_id' => $this->creator->id,
            'title' => 'test title',
            'content' => 'test content',
            'target_amount' => 10000000,
            'release_status' => '掲載中',
            'start_date' => now(),
            'end_date' => now()
        ])->create();

        $this->plan = Plan::factory()->state([
            'project_id' => $this->project->id,
            'image_url' => UploadedFile::fake()->image('test_image_first.jpg')->name,
            'title' => 'test title',
            'content' => 'test content',
            'price' => 10000,
            'delivery_date' => now(),
            'limit_of_supporters' => 50
        ])->create();

        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret_for_test'));

        $params = [
            'card' => [
                "number" => "4242424242424242",
                "exp_month" => "12",
                "exp_year" => "2024",
            ]
        ];

        $this->success_token = \Payjp\Token::create($params, $options = ['payjp_direct_token_generate' => 'true']);

        $this->success_payment = Payment::factory()->state([
                    'user_id' => $this->supporter->id,
                    'price' => $this->plan->price,
                    'message_status' => 'ステータスなし',
                    'merchant_payment_id' => UniqueToken::getToken(),
                    'pay_jp_id' => $this->success_token->id,
                    'payment_is_finished' => false,
                    'remarks' => 'test remarks'
                ])->create();

        $this->url = "project/{$this->project->id}/plan/confirmPayment";
    }

    public function testPaymentForPayJpAction()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->supporter)
                        ->from($this->url)
                        ->get(route('user.plan.paymentForPayJp', [
                            'project' => $this->project,
                            'payment' => $this->success_payment
                        ])
                    );
        $response->assertOk();
        $payment =Payment::find($this->success_payment->id);
        $this->assertSame(1, $payment->payment_is_finished);
    }
}
