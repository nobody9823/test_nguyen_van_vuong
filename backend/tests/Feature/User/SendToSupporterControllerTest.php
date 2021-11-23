<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Models\Identification;
use App\Models\Address;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\PaymentToken;
use App\Models\MessageContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SendToSupporterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory()
            ->has(Identification::factory())
            ->has(Address::factory())
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

        $this->users->each(function (User $user) {
            $user->payments()->saveMany(
                Payment::factory()->state(['payment_is_finished' => true])->count(10)
                    ->has(PaymentToken::factory())
                    ->has(MessageContent::factory()->count(20))
                    ->create()
            );
        });

        Payment::all()->each(function (Payment $payment) {
            $payment->includedPlans()->attach(
                [Plan::whereIn('project_id', Project::where('id', $payment->project_id)->select('id'))->inRandomOrder()->first()->id => ['quantity' => random_int(1, 3)]]
            );
        });

        $this->user = $this->users->first();

        $this->project = $this->user->projects()->first();

        $this->payments = $this->project->payments;
    }

    /**
     * A basic send to supporter controller test example.
     *
     * @return void
     */
    public function testSendToSupporterController()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
            ->post(route('user.send_to_supporter', ['project' => $this->project, 'payment_ids' => $this->payments->pluck('id')->toArray()]));

        $response->assertRedirect(route('user.supporter.index', ['project' => $this->project]));
    }
}
