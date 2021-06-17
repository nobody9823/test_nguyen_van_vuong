<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use App\Models\Project;
use App\Models\RepliesToSupporterComment;
use App\Models\SupporterComment;
use App\Models\UserSupporterCommentLiked;
use App\Models\Talent;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Enums\ProjectReleaseStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class SupporterCommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // FIXME 複雑になってしまったのでもっと良い方法があれば...
    public function setUp() :void
    {
        parent::setUp();

        $this->companies = Company::factory()
            ->count(3)
            ->state(new Sequence(
                [
                    'name' => 'test_company_first',
                    'email' => 'test_company_first@example.com',
                    'password' => 'password',
                ],
                [
                    'name' => 'test_company_second',
                    'email' => 'test_company_second@example.com',
                    'password' => 'password',
                ],
                [
                    'name' => 'test_company_third',
                    'email' => 'test_company_third@example.com',
                    'password' => 'password',
                ],
            ))->create();

        $this->talents = Talent::factory()
            ->count(3)
            ->state(new Sequence(
                [
                    'company_id' => $this->companies[0]->id,
                    'name' => 'test_talent_first',
                    'email' => 'talent_first@example.com',
                ],
                [
                    'company_id' => $this->companies[1]->id,
                    'name' => 'test_talent_second',
                    'email' => 'talent_second@example.com',
                ],
                [
                    'company_id' => $this->companies[2]->id,
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
                    'created_at' => new Carbon('+1 week')
                ],
                [
                    'project_id' => $this->projects[1]->id,
                    'user_id' => $this->users[1]->id,
                    'content' => 'test_supporter_comment_content_second',
                    'created_at' => new Carbon('+2 weeks')
                ],
                [
                    'project_id' => $this->projects[2]->id,
                    'user_id' => $this->users[2]->id,
                    'content' => 'test_supporter_comment_content_third',
                    'created_at' => new Carbon('+3 weeks')
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

            $this->user_supporter_comment_likeds = UserSupporterCommentLiked::factory()
                ->count(3)
                ->state(new Sequence(
                    [
                        'supporter_comment_id' => $this->supporter_comments[0]->id,
                        'user_id' => $this->users[0]->id,
                    ],
                    [
                        'supporter_comment_id' => $this->supporter_comments[1]->id,
                        'user_id' => $this->users[1]->id,
                    ],
                    [
                        'supporter_comment_id' => $this->supporter_comments[2]->id,
                        'user_id' => $this->users[2]->id,
                    ],
                ))->create();
    }

    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testScopeGetSupporterCommentsByCompany()
    {
        $this->actingAs($this->companies[0]);
        $supporter_comments = SupporterComment::getSupporterCommentsByCompany()->get();

        $this->assertCount(1, $supporter_comments);
    }

    public function testScopeGetSupporterCommentsByTalent()
    {
        $this->actingAs($this->talents[0]);
        $supporter_comments = SupporterComment::getSupporterCommentsByTalent()->get();

        $this->assertCount(1, $supporter_comments);
    }

    public function testScopeSearchWordsInTheCaseOfUserName()
    {
        $data = [
            0 => 'test',
            1 => 'user_first',
        ];

        $expected_data = 'test_supporter_comment_content_first';

        $supporter_comments = SupporterComment::searchByWords($data)->get();

        $this->assertCount(1, $supporter_comments);
        $this->assertSame($supporter_comments->first()->content, $expected_data);
    }

    public function testScopeSearchWordsInTheCaseOfSupporterCommentContent()
    {
        $data = [
            0 => 'test',
            1 => 'comment_content_first',
        ];

        $expected_data = 'test_supporter_comment_content_first';

        $supporter_comments = SupporterComment::searchByWords($data)->get();

        $this->assertCount(1, $supporter_comments);
        $this->assertSame($supporter_comments->first()->content, $expected_data);
    }

    public function testScopeSearchWordsInTheCaseOfProjectTitle()
    {
        $data = [
            0 => 'test',
            1 => 'title_first',
        ];

        $expected_data = 'test_supporter_comment_content_first';

        $supporter_comments = SupporterComment::searchByWords($data)->get();

        $this->assertCount(1, $supporter_comments);
        $this->assertSame($supporter_comments->first()->content, $expected_data);
    }

    public function testScopeSearchWordsInTheCaseOfTalentName()
    {
        $data = [
            0 => 'test',
            1 => 'talent_first',
        ];

        $expected_data = 'test_supporter_comment_content_first';

        $supporter_comments = SupporterComment::searchByWords($data)->get();

        $this->assertCount(1, $supporter_comments);
        $this->assertSame($supporter_comments->first()->content, $expected_data);
    }

    public function testScopeSearchWordInTheCaseOfReplyComment()
    {
        $data = [
            0 => 'test',
            1 => 'reply_content_first',
        ];

        $expected_data = 'test_supporter_comment_content_first';

        $supporter_comments = SupporterComment::searchByWords($data)->get();

        $this->assertCount(1, $supporter_comments);
        $this->assertSame($supporter_comments->first()->content, $expected_data);
    }

    public function testSearchByProject()
    {
        $data = $this->projects[0]->id;

        $expected_data = 'test_supporter_comment_content_first';

        $supporter_comments = SupporterComment::searchByProject($data)->get();

        $this->assertCount(1, $supporter_comments);
        $this->assertSame($supporter_comments->first()->content, $expected_data);
    }

    public function testSoftDeleteIsSuccess()
    {
        $this->actingAs($this->companies[0]);

        $supporter_comment_id = $this->supporter_comments[0]->id;

        $this->supporter_comments[0]->delete();

        $deletedSupporterComment = SupporterComment::onlyTrashed()->where('id', $supporter_comment_id)->get();

        $deletedRepliesToSupporterComment = RepliesToSupporterComment::onlyTrashed()->where('supporter_comment_id', $supporter_comment_id)->get();

        $deletedUserSupporterCommentLiked = UserSupporterCommentLiked::onlyTrashed()->where('supporter_comment_id', $supporter_comment_id)->get();

        $this->assertCount(1, $deletedSupporterComment);
        $this->assertCount(1, $deletedRepliesToSupporterComment);
        $this->assertCount(1, $deletedUserSupporterCommentLiked);
    }

    public function testSearchWithPostDates()
    {
        $from_date = [
            0 => now()
        ];
        $to_date = [
            0 => new Carbon('+8 days')
        ];
        $this->actingAs($this->companies[0]);
        $supporter_comments = SupporterComment::searchWithPostDates($from_date, $to_date)->get();
        $this->assertCount(1, $supporter_comments);
    }
}
