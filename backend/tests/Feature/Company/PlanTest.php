<?php

namespace Tests\Feature\Company;

use App\Http\Controllers\Company\PlanController;
use App\Models\Company;
use App\Models\Option;
use App\Models\Plan;
use App\Models\Project;
use App\Models\Talent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->company = Company::factory()
            ->state([
                'name' => 'test_company',
                'email' => 'test@example.com',
                'password' => 'password',
            ])->create();

        $this->talent = Talent::factory()
            ->state(
            [
                'company_id' => $this->company->id,
                'name' => 'test_talent_first',
                'email' => 'talent_first@example.com',
            ])->create();

            $this->projects = Project::factory()
            ->count(3)
            ->state(new Sequence(
                [
                    'talent_id' => $this->talent->id,
                    'title' => 'test_project_title_first',
                    'explanation' => 'test_project_explanation_first',
                    'release_status' => '---',
                    'start_date' => now(),
                    'end_date' => now(),
                    'target_amount' => 100000,
                ],
                [
                    'talent_id' => $this->talent->id,
                    'title' => 'test_project_title_second',
                    'explanation' => 'test_project_explanation_second',
                    'release_status' => '承認待ち',
                    'start_date' => now(),
                    'end_date' => now(),
                    'target_amount' => 200000,
                ],
                [
                    'talent_id' => $this->talent->id,
                    'title' => 'test_project_title_third',
                    'explanation' => 'test_project_explanation_third',
                    'release_status' => '掲載中',
                    'start_date' => now(),
                    'end_date' => now(),
                    'target_amount' => 300000,
                ]
            ))->create();

            $this->plans = Plan::factory()
            ->count(3)
            ->state(new Sequence([
                'project_id' => $this->projects[0]->id,
                'title' => 'test_plan_title_first',
                'content' => 'test_plan_content_first',
                'image_url' => UploadedFile::fake()->image('test_image_first.jpg')->name,
            ],
            [
                'project_id' => $this->projects[1]->id,
                'title' => 'test_plan_title_second',
                'content' => 'test_plan_content_second',
                'image_url' => UploadedFile::fake()->image('test_image_second.jpg')->name,
            ],
            [
                'project_id' => $this->projects[2]->id,
                'title' => 'test_plan_title_third',
                'content' => 'test_plan_content_third',
                'image_url' => UploadedFile::fake()->image('test_image_third.jpg')->name,
            ]))->create();

            $this->options = Option::factory()
            ->count(3)
            ->state(new Sequence([
                'plan_id' => $this->plans[0],
                'name' => 'test_option_first',
                'quantity' => 10,
            ],
            [
                'plan_id' => $this->plans[1],
                'name' => 'test_option_second',
                'quantity' => 20,
            ],
            [
                'plan_id' => $this->plans[2],
                'name' => 'test_option_third',
                'quantity' => 30,
            ]))->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexAction()
    {
        $response = $this->actingAs($this->company, 'company')
        ->get(route('company.plan.index'));

        $response->assertOk();
        $response->assertSee('プラン一覧');
    }

    public function testCreateAction()
    {
        $response = $this->actingAs($this->company, 'company')
        ->get(route('company.plan.create', ['project' => $this->projects[0]]));

        $response->assertOk();
        $response->assertSee('プラン新規作成');
    }

    public function testStoreAction()
    {
        $data = [
            'title' => 'new_test_plan_title',
            'content' => 'new_test_plan_content',
            'price' => 4000,
            'estimated_return_date' => Carbon::now()->addMonth(2)->format('Y-m-d'),
            'options' => [
                0 => [
                    'name' => 'new_test_option_first',
                    'quantity' => '1',
                ],
                1 => [
                    'name' => 'new_test_option_second',
                    'quantity' => '2',
                ],
            ],
        ];

        $response = $this->actingAs($this->company, 'company')
            ->from(route('company.plan.create', ['project' => $this->projects[0]]))
            ->post(route('company.plan.store', ['project' => $this->projects[0]]), $data);

        $response->assertRedirect(action([PlanController::class, 'search'], ['project' => $this->projects[0], 'plans' => $this->projects[0]->plans()->paginate(10)]));
        $this->assertDatabaseCount('plans', 4);
        $this->assertDatabaseHas('plans', ['title' => 'new_test_plan_title']);
        $this->assertDatabaseCount('options', 5);
        $this->assertDatabaseHas('options', ['name' => 'new_test_option_first', 'quantity' => 1]);
    }

    public function testShowAction()
    {
        $data = [
            'test_plan_title_first',
            'test_plan_content_first',
        ];

        $response = $this->actingAs($this->company, 'company')
            ->get(route('company.plan.show', ['plan' => $this->plans[0]]));

        $response->assertOk();
        $response->assertSeeInOrder($data);
    }

    public function testEditAction()
    {
        $data = [
            'test_plan_title_first',
            'test_plan_content_first',
        ];

        $response = $this->actingAs($this->company, 'company')
            ->get(route('company.plan.edit', ['project' => $this->projects[0], 'plan' => $this->plans[0]]));

        $response->assertOk();
        $response->assertSee($data);
    }

    public function testUpdateAction()
    {
        $data = [
            'title' => 'updated_test_plan_title',
            'content' => 'updated_test_plan_content',
            'price' => 4000,
            'estimated_return_date' => Carbon::now()->addMonth(2)->format('Y-m-d'),
            'options' => [
                0 => [
                    'name' => 'updated_test_option_first',
                    'quantity' => '1',
                ],
                1 => [
                    'name' => 'updated_test_option_second',
                    'quantity' => '2',
                ],
            ],
        ];

        $response = $this->actingAs($this->company, 'company')
            ->from(route('company.plan.edit', ['project' => $this->projects[0], 'plan' => $this->plans[0]]))
            ->patch(route('company.plan.update', ['project' => $this->projects[0], 'plan' => $this->plans[0]]), $data);

        $response->assertRedirect(action([PlanController::class, 'search'], ['project' => $this->projects[0], 'plans' => $this->projects[0]->plans()->paginate(10)]));
        $this->assertDatabaseCount('plans', 3);
        $this->assertDatabaseHas('plans', ['title' => 'updated_test_plan_title']);
        $this->assertDatabaseCount('options', 5);
        $this->assertDatabaseHas('options', ['name' => 'updated_test_option_first', 'quantity' => 1]);
    }

    public function testDestroyAction()
    {
        $response = $this->actingAs($this->company, 'company')
            ->from(route('company.plan.search', ['project' => $this->projects[0]]))
            ->delete(route('company.plan.destroy', ['plan' => $this->plans[0]]));

        $response->assertRedirect(action([PlanController::class, 'search'], ['project' => $this->projects[0], 'plans' => $this->projects[0]->plans()->paginate(10)]));
        $this->assertSoftDeleted($this->plans[0]);
        $this->assertSoftDeleted($this->options[0]);
    }

    public function testSearchAction()
    {
        $expected_data = [
            'test'
        ];

        $response = $this->actingAs($this->company, 'company')
            ->from(route('company.plan.index'))
            ->get(route('company.plan.search', ['word' => 'test']));

        $response->assertOk();
        $response->assertSeeTextInOrder($expected_data);
    }

    public function testDeleteImageAction()
    {
        $response = $this->actingAs($this->company, 'company')
            ->from(route('company.plan.edit', ['project' => $this->projects[0], 'plan' => $this->plans[0]]))
            ->json('DELETE', route('company.plan_image.destroy', ['plan' => $this->plans[0]]));

        $response->assertOk();
        $this->assertEquals('public/sampleImage/now_printing.png', Plan::find($this->plans[0]->id)->image_url);
    }

    public function testDeleteOptionAction()
    {
        $response = $this->actingAs($this->company, 'company')
            ->from(route('company.plan.edit', ['project' => $this->projects[0], 'plan' => $this->plans[0]]))
            ->json('DELETE', route('company.option.destroy', ['option' => $this->options[0]]));

        $response->assertOk();
        $this->assertSoftDeleted($this->options[0]);
    }
}
