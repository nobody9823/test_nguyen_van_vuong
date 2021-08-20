<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Project;
use App\Models\Comment;
use App\Models\Reply;
use Tests\TestCase;

class ReplyControllerTest extends TestCase
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

        $this->user = User::factory()->create();

        $this->project = Project::factory()->state([
            'user_id' => $this->user->id,
            'release_status' => '掲載中'
        ])->create();

        $this->comment = Comment::factory()->state([
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ])->create();

        $this->reply = Reply::factory()->state([
            'comment_id' => $this->comment->id
        ])->create();
    }

    public function testStoreAction()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.project.show', ['project' => $this->project]))
                         ->post(route('user.reply.store', ['project' => $this->project, 'comment' => $this->comment]),
        [
            'comment_id' => $this->comment->id,
            'content' => $this->reply->content,
        ]);
        $response->assertRedirect(route('user.comment.index', ['project' => $this->project]));
    }
}
