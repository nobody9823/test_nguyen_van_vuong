<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Project;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\PaymentToken;
use Tests\TestCase;
use Exception;
use App\Traits\UniqueToken;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;

class ProjectControllerForStripeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Config::set('app.card_payment_api', 'stripe');

        $this->creator = User::factory()->hasProfile()->create();

        $this->supporter = User::factory()->hasProfile()->create();

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

        $this->stripe = new \Stripe\StripeClient(config('app.stripe_secret'));

        $params = [
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => '12',
                'exp_year' => '2024',
                'cvc' => '314',
            ]
        ];

        $this->success_payment_methods = $this->stripe->paymentMethods->create($params);

        $params = [
            'type' => 'card',
            'card' => [
                'number' => '4000000000000341',
                'exp_month' => '12',
                'exp_year' => '2024',
                'cvc' => '314',
            ]
        ];

        $this->fail_payment_methods = $this->stripe->paymentMethods->create($params);

        $this->success_payment = Payment::factory()->state([
            'project_id' => $this->project->id,
            'user_id' => $this->supporter->id,
            'price' => $this->plan->price,
            'message_status' => 'ステータスなし',
            'payment_way' => 'Stripe',
            'payment_is_finished' => false,
            'remarks' => 'test remarks'
        ])->create();

        $this->success_payment->paymentToken()->save(PaymentToken::factory()->state([
            'token' => $this->success_payment_methods->id,
        ])->make());

        $this->fail_payment = Payment::factory()->state([
            'project_id' => $this->project->id,
            'user_id' => $this->supporter->id,
            'price' => $this->plan->price,
            'message_status' => 'ステータスなし',
            'payment_way' => 'Stripe',
            'payment_is_finished' => false,
            'remarks' => 'test remarks'
        ])->create();

        $this->fail_payment->paymentToken()->save(PaymentToken::factory()->state([
            'token' => $this->fail_payment_methods->id,
        ])->make());

        $this->url = "project/{$this->project->id}/plan/confirmPayment";
    }

    // public function testPaymentForStripeActionIsSuccess()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->supporter)
    //         ->from($this->url)
    //         ->get(
    //             route('user.plan.payment_for_credit', [
    //                 'project' => $this->project,
    //                 'payment' => $this->success_payment
    //             ])
    //         );
    //     $response->assertOk();
    //     $payment = Payment::find($this->success_payment->id);
    //     $this->assertSame(1, $payment->payment_is_finished);
    // }

    // public function testPaymentForStripeActionIsFail()
    // {
    //     $this->withoutExceptionHandling();
    //     $this->expectException(Exception::class);
    //     ($this->actingAs($this->supporter)
    //         ->from($this->url)
    //         ->get(
    //             route('user.plan.payment_for_credit', [
    //                 'project' => $this->project,
    //                 'payment' => $this->fail_payment
    //             ])
    //         ))->execute(1);
    // }
}
