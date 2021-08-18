<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Project;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    Public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
        ->has(Project::factory(10))->create();

        $this->project = $this->user->projects()->first();;
    }


    public function testIndexAction()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)
                         ->from(route('user.my_project.project.show', ['project' => $this->project]))
                         ->get(route('user.comment.index', ['project' => $this->project]));
        $response->assertViewIs('user.comment.index');
        $response->assertOk();
    }
}
