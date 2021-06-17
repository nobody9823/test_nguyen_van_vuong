<?php

namespace Tests\Feature\Admin\Project;

use App\Models\Admin;
use App\Models\Project;
use App\Models\User;
use App\Models\UserProjectLiked;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeCalculationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
        $this->users = User::factory(3)->create();
        $this->projects = Project::factory(3)->state(['added_like' => 10])->create();
        UserProjectLiked::factory(3)
            ->state(new Sequence(
                [
                    'user_id' => $this->users[0]->id,
                    'project_id' => $this->projects[0]->id,
                ],
                [
                    'user_id' => $this->users[1]->id,
                    'project_id' => $this->projects[1]->id,
                ],
                [
                    'user_id' => $this->users[2]->id,
                    'project_id' => $this->projects[2]->id,
                ],
            ))->create();
    }
    /**
     * test for Increment Likes Action
     *
     * @param array
     * @param array
    * @dataProvider dataIncrementLikesAction
    */
    public function testIncrementLikesAction($point, int $status, array $keys, array $values)
    {
        $response = $this->actingAs($this->admin, 'admin')
                            ->json('PATCH', route('admin.project.increment_likes', ['project' => $this->projects[0]]), ['add_point' => $point]);
        $expected_data = array_combine($keys, $values);

        $response->assertStatus($status)
                    ->assertJson($expected_data);
    }

    public function dataIncrementLikesAction()
    {
        return [
            'success by 1 point' => [
                1,
                200,
                ['result', 'total_likes'],
                ['success', 12],
            ],
            'success by 10 points' => [
                10,
                200,
                ['result', 'total_likes'],
                ['success', 21],
            ],
            'If incrementPoints value are type of string' => [
                'test',
                422,
                ['result', 'total_likes'],
                ['failed', 11],
            ]
        ];
    }
    /**
     * test for Decrement Likes Action
     *
     * @param array
     * @param array
    * @dataProvider dataDecrementLikesAction
    */
    public function testDecrementLikesAction($point, int $status, array $keys, array $values)
    {
        $response = $this->actingAs($this->admin, 'admin')
                            ->json('PATCH', route('admin.project.decrement_likes', ['project' => $this->projects[0]]), ['sub_point' => $point]);
        $expected_data = array_combine($keys, $values);

        $response->assertStatus($status)
                    ->assertJson($expected_data);
    }

    public function dataDecrementLikesAction()
    {
        return [
            'success by 1 point' => [
                1,
                200,
                ['result', 'total_likes'],
                ['success', 10],
            ],
            'success by 10 points' => [
                10,
                200,
                ['result', 'total_likes'],
                ['success', 1],
            ],
            'If decrementPoints value are type of string' => [
                'test',
                422,
                ['result', 'total_likes'],
                ['failed', 11],
            ],
            'If total likes count are less than 0' => [
                50,
                422,
                ['result', 'total_likes'],
                ['failed', 11],
            ],
        ];
    }
}
