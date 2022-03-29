<?php

namespace Tests\Feature\User;

use App\Models\Payment;
use App\Models\PaymentToken;
use App\Models\Project;
use App\Models\Plan;
use App\Models\MessageContent;
use App\Models\ProjectFile;
use App\Models\User;
use App\Models\Identification;
use App\Models\Address;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Exception;

class SupporterControllerTest extends TestCase
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
                Payment::factory()->count(10)
                    ->has(PaymentToken::factory())
                    ->has(MessageContent::factory()->count(20))
                    ->create()
            );
        });

        Payment::all()->each(function (Payment $payment) {
            $payment->includedPlans()->attach(
                [Plan::whereIn('project_id', Project::where('id', $payment->project_id)->select('id'))->inRandomOrder()->first()->id => ['quantity' => random_int(1, 3)]]
            );
            $payment->includedAddress()->attach($payment->user->address()->inRandomOrder()->first()->id);
        });

        $this->user = $this->users->first();

        $this->project = $this->user->projects()->first();

        $this->unauthorizedProject = User::latest('id')->first()->projects()->first();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserSupporterIndexPage()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->get(route('user.supporter.index', ['project' => $this->project]));

        $response->assertStatus(200);
    }

    public function testUserSupporterIndexPageIsFailBecauseOfNotOwnProject()
    {
        $this->withoutExceptionHandling();
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('This action is unauthorized.');

        ($this->actingAs($this->user)->get(route('user.supporter.index', ['project' => $this->unauthorizedProject])))->execute(1);
    }
}
