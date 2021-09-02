<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Payment;
use App\Models\PaymentToken;
use App\Models\Plan;

class MypageControllerTest extends TestCase
{
    use RefreshDatabase;

    Public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->project = Project::factory()->state([
            'user_id' => $this->user->id,
        ])->create();

        $this->payment = Payment::factory()->state([
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ])->create();

        $this->plan = Plan::factory()->state([
            'project_id' => $this->project->id,
        ])->create();

        $this->payment_token = PaymentToken::factory()->state([
            'payment_id' => $this->payment->id,            
        ])->create();

        $this->payment->includedPlans()->attach($this->plan->id ,['quantity' => 1]);
    }

    public function testPaymentHistory()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.profile'))
                         ->get(route('user.payment_history'));
        $response->assertOk()
                 ->assertViewIs('user.mypage.payment')
                 ->assertViewHas(['payments' ,'project']);
    }

    public function testContributionComments()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.profile'))
                         ->get(route('user.contribution_comments'));
        $response->assertOk()
                 ->assertViewIs('user.mypage.comment')
                 ->assertViewHas('comments');
    }
    
    public function testPurchasedProjects()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.profile'))
                         ->get(route('user.purchased_projects'));
        $response->assertOk()
                 ->assertViewIs('user.mypage.project')
                 ->assertViewHas('projects');
    }
}
