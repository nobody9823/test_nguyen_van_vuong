<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Project;
use App\Models\Comment;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    Public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->project = Project::factory()->state([
            'user_id' => $this->user->id,
            'release_status' => '掲載中'
        ])->create();

        $this->comment = Comment::factory()->state([
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ])->create();
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

    public function testStoreAction()
    {        
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.project.show', ['project' => $this->project]))
                         ->post(route('user.comment.store', ['project' => $this->project, 'comment' => $this->comment]),
        [
            'user_id' => $this->user->id,
            'project_id' => $this->project->id,
            'content' => $this->comment->content,
        ]);
        $response->assertRedirect(route('user.project.show', ['project' => $this->project]));
    }

    public function testDestroyAction()
    {
        $this->withoutExceptionHandling();

        $this->comment->save();
        $response = $this->actingAs($this->user)
                         ->from(route('user.comment.index', ['project' => $this->project]))
                         ->delete(route('user.comment.destroy', ['project' => $this->project, 'comment' => $this->comment]));
        $response->assertRedirect(route('user.comment.index', ['project' => $this->project]));
        $this->assertSoftDeleted($this->comment);
        $this->assertEquals(0, Comment::count());
    }
}
