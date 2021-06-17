<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Project;
use App\Models\RepliesToSupporterComment;
use App\Models\SupporterComment;
use App\Models\Talent;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Enums\ProjectReleaseStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupporterCommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // FIXME 複雑になってしまったのでもっと良い方法があれば...
    public function setUp() :void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->company = Company::factory()->state([
            'name' => 'test_company',
            'email' => 'test@example.com',
            'password' => 'password',
        ])->create();

        $this->talents = Talent::factory()
            ->count(3)
            ->state(new Sequence(
                [
                    'company_id' => $this->company->id,
                    'name' => 'test_talent_first',
                    'email' => 'talent_first@example.com',
                ],
                [
                    'company_id' => $this->company->id,
                    'name' => 'test_talent_second',
                    'email' => 'talent_second@example.com',
                ],
                [
                    'company_id' => $this->company->id,
                    'name' => 'test_talent_third',
                    'email' => 'talent_third@example.com',
                ],
            ))->create();

        $this->projects = Project::factory()
            ->count(3)
            ->state(new Sequence(
                [
                    'talent_id' => $this->talents[0]->id,
                    'title' => 'test_project_title_first',
                    'explanation' => 'test_project_explanation_first',
                    'release_status' => Arr::random(
                        ProjectReleaseStatus::getValues()
                    ),
                    'start_date' => now(),
                    'end_date' => now(),
                    'target_amount' => 100000,
                ],
                [
                    'talent_id' => $this->talents[1]->id,
                    'title' => 'test_project_title_second',
                    'explanation' => 'test_project_explanation_second',
                    'release_status' => Arr::random(
                        ProjectReleaseStatus::getValues()
                    ),
                    'start_date' => now(),
                    'end_date' => now(),
                    'target_amount' => 200000,
                ],
                [
                    'talent_id' => $this->talents[2]->id,
                    'title' => 'test_project_title_third',
                    'explanation' => 'test_project_explanation_third',
                    'release_status' => Arr::random(
                        ProjectReleaseStatus::getValues()
                    ),
                    'start_date' => now(),
                    'end_date' => now(),
                    'target_amount' => 300000,
                ]
            ))->create();

        $this->users = User::factory()
            ->count(3)
            ->state(new Sequence(
                [
                    'name' => 'test_user_first',
                    'email' => 'test_user_first@example.com',
                ],
                [
                    'name' => 'test_user_second',
                    'email' => 'test_user_second@example.com',
                ],
                [
                    'name' => 'test_user_third',
                    'email' => 'test_user_third@example.com',
                ]
            ))->create();

        $this->supporter_comments = SupporterComment::factory()
            ->count(3)
            ->state(new Sequence(
                [
                    'project_id' => $this->projects[0]->id,
                    'user_id' => $this->users[0]->id,
                    'content' => 'test_supporter_comment_content_first',
                ],
                [
                    'project_id' => $this->projects[1]->id,
                    'user_id' => $this->users[1]->id,
                    'content' => 'test_supporter_comment_content_second',
                ],
                [
                    'project_id' => $this->projects[2]->id,
                    'user_id' => $this->users[2]->id,
                    'content' => 'test_supporter_comment_content_third',
                ]
            ))->create();

        $this->replies_to_supporter_comments = RepliesToSupporterComment::factory()
            ->count(3)
            ->state(new Sequence(
                [
                    'supporter_comment_id' => $this->supporter_comments[0]->id,
                    'talent_id' => $this->talents[0]->id,
                    'content' => 'test_reply_content_first',
                ],
                [
                    'supporter_comment_id' => $this->supporter_comments[1]->id,
                    'talent_id' => $this->talents[1]->id,
                    'content' => 'test_reply_content_second',
                ],
                [
                    'supporter_comment_id' => $this->supporter_comments[2]->id,
                    'talent_id' => $this->talents[2]->id,
                    'content' => 'test_reply_content_third',
                ],
            ))->create();
    }

    public function testSearchActionByWords()
    {
        $expected_data = [
            'test'
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->get(route('admin.supporter_comment.search', ['word' => 'test']));

        $response->assertOk();
        $response->assertSeeTextInOrder($expected_data);
    }

    public function testSearchActionByProject()
    {
        $expected_data = [
            'test_supporter_comment_content_first',
        ];

        $response = $this->actingAs($this->admin, 'admin')
        ->get(route('admin.supporter_comment.search', ['project_id' => $this->projects[0]->id]));

        $response->assertOk();
        $response->assertSeeTextInOrder($expected_data);
    }

    public function testDeleteAction()
    {
        $response = $this->actingAs($this->admin, 'admin')
                        ->delete(route('admin.supporter_comment.destroy', ['supporter_comment' => $this->supporter_comments[0]]));

        $response->assertRedirect(route('admin.supporter_comment.index'));
    }
}
