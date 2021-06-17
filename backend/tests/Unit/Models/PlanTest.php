<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use App\Models\Option;
use App\Models\Talent;
use App\Models\Project;
use App\Models\Plan;
use App\Models\UserPlanCheering;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;
use Carbon\Carbon;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->company = Company::create([
                'name' => 'valleyin',
                'email' => 'test@valleyin.co.jp',
                'password' => 'valleyin',
                'image_url' => 'public/image/companySample.jpg'
            ]);

        $this->talent = $this->company->talents()->create([
                    'name' => 'talent',
                    'email' => 'talent@talent.co.jp',
                    'email_verified_at' => now(),
                    'password' => 'talent',
                    'image_url' => 'public/image/projectImageSample.jpg',
                    'remember_token' => Str::random(10),
                ]);

        $this->project = $this->talent->projects()->saveMany(Project::factory(1)->make())->first();

        $this->plans = Plan::factory()
        ->count(3)
        ->state(new Sequence(
            [
                'project_id' => $this->project->id,
                'image_url' => 'public/image/planImageSample.jpg',
                'title' => 'test title 1',
                'content' => 'test content 1',
                'price' => 1000,
                'estimated_return_date' => new Carbon('+1 week'),
                'necessary_address' => 1,
            ],
            [
                'project_id' => $this->project->id,
                'image_url' => 'public/image/planImageSample.jpg',
                'title' => 'test title 2',
                'content' => 'test content 2',
                'price' => 2000,
                'estimated_return_date' => new Carbon('+2 weeks'),
                'necessary_address' => 1,
            ],
            [
                'project_id' => $this->project->id,
                'image_url' => 'public/image/planImageSample.jpg',
                'title' => 'test title 3',
                'content' => 'test content 3',
                'price' => 3000,
                'estimated_return_date' => new Carbon('+3 weeks'),
                'necessary_address' => 1,
            ]
        ))->create();

        $this->user_plan_cheering = $this->plans[0]->userPlanCheering()->saveMany(UserPlanCheering::factory(1)->make())->first();

        $this->option = $this->plans[0]->options()->saveMany(Option::factory(1)->make())->first();
    }

    public function testSoftDeleteIsSuccess()
    {
        $this->actingAs($this->company);

        $plan_id= $this->plans[0]->id;

        $this->plans[0]->delete();
        $deletedPlan = Plan::onlyTrashed()->where('id', $plan_id)->get();

        $deletedUserPlanCheering = UserPlanCheering::onlyTrashed()->where('plan_id', $plan_id)->get();
        $deletedOption = Option::onlyTrashed()->where('plan_id', $plan_id)->get();

        $this->assertCount(1, $deletedPlan);
        $this->assertCount(1, $deletedUserPlanCheering);
        $this->assertCount(1, $deletedOption);
    }

    public function testScopeSearchByWords()
    {
        $data = [
            0 => 'test title 1'
        ];
        $this->actingAs($this->company);
        $plans = Plan::searchByWords($data)->get();
        $this->assertCount(1, $plans);
    }

    public function testScopeSearchWithPrice()
    {
        $min_price = [
            0 => 1000
        ];
        $max_price = [
            0 => 1500
        ];
        $this->actingAs($this->company);
        $plans = Plan::searchWithPrice($min_price, $max_price)->get();
        $this->assertCount(1, $plans);
    }

    public function testScopeSearchWithEstimatedReturnDate()
    {
        $from_date = [
            0 => now()
        ];
        $to_date = [
            0 => new Carbon('+8 days')
        ];
        $this->actingAs($this->company);
        $plans = Plan::searchWithEstimatedReturnDate($from_date, $to_date)->get();
        $this->assertCount(1, $plans);
    }
}
