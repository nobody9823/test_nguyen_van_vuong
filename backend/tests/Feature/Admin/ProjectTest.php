<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Curator;
use App\Models\Plan;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // リレーションで色々詰まったのですべて書いちゃった
        $this->admin = Admin::factory()->create();
        $this->curator = Curator::factory()->create();
        $this->user = User::factory()->valleyin()->hasProfile()->create();
        $this->tag = Tag::factory()->create();
        $this->project = Project::factory()->state([
            'user_id' => $this->user->id,
            'curator_id' => $this->curator->id,
        ])->make();
    }

    /**
     * A basic test of index.
     *
     * @return void
     */
    public function test_index()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.project.index'));
        $response->assertViewIs('admin.project.index');
        $response->assertOk();
    }

    /**
     * A basic test of create
     *
     * @return void
     */
    public function test_create()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.project.create'));
        $response->assertViewIs('admin.project.create');
        $response->assertOk();
    }

    /**
     * A basic test of store
     *
     * @return void
     */
    public function test_store()
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpeg');
        $start_date = new Carbon($this->project->start_date);
        $end_date = new Carbon($this->project->end_date);
        $response = $this->actingAs($this->admin, 'admin')->from(route('admin.project.create'))->post(route('admin.project.store'), [
            'user_id' => $this->user->id,
            'title' => $this->project->title,
            'content' => $this->project->content,
            'target_amount' => $this->project->target_amount,
            'reward_by_total_amount' => $this->project->reward_by_total_amount,
            'reward_by_total_quantity' => $this->project->reward_by_total_quantity,
            'curator_id' => $this->curator->id,
            'tags' => [$this->tag->id],
            'start_date' => $start_date->format('Y-m-d H:i:s'),
            'end_date' => $end_date->format('Y-m-d H:i:s'),
            'release_status' => $this->project->release_status,
            'images' => [$file],
        ]);
        $response->assertRedirect('/admin/project/' . Project::first()->id . '/plan/create');
    }

    /**
     * A basic test of show
     *
     * @return void
     */
    public function test_show()
    {
        $this->withoutExceptionHandling();
        $this->project->save();
        $response = $this->actingAs($this->admin, 'admin')->from(route('admin.project.index'))->get(route('admin.project.show', ['project' => $this->project]));
        $response->assertOk();
        $response->assertViewIs('admin.project.show');
    }

    /**
     * A basic test of edit
     *
     * @return void
     */
    public function test_edit()
    {
        $this->withoutExceptionHandling();
        $this->project->save();
        $response = $this->actingAs($this->admin, 'admin')->from(route('admin.project.index'))->get(route('admin.project.edit', ['project' => $this->project]));
        $response->assertOk();
        $response->assertViewIs('admin.project.edit');
    }

    /**
     * A basic test of update
     *
     * @return void
     */
    public function test_update()
    {
        $this->project->save();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpeg');
        $start_date = new Carbon($this->project->start_date);
        $end_date = new Carbon($this->project->end_date);
        $response = $this->actingAs($this->admin, 'admin')->from(route('admin.project.edit', ['project' => $this->project]))->put(route('admin.project.update', ['project' => $this->project]), [
            'user_id' => $this->project->user_id,
            'title' => $this->project->title,
            'content' => $this->project->content,
            'reward_by_total_amount' => $this->project->reward_by_total_amount,
            'reward_by_total_quantity' => $this->project->reward_by_total_quantity,
            'target_amount' => $this->project->target_amount,
            'curator_id' => $this->curator->id,
            'tags' => [$this->tag->id],
            'start_date' => $start_date->format('Y-m-d H:i:s'),
            'end_date' => $end_date->format('Y-m-d H:i:s'),
            'release_status' => $this->project->release_status,
            'images' => [$file],
        ]);
        $response->assertRedirect(route('admin.project.index'));
    }

    /**
     * A basic test of delete
     *
     * @return void
     */
    public function test_delete()
    {
        $this->project->save();
        $response = $this->actingAs($this->admin, 'admin')->from(route('admin.project.index'))->delete(route('admin.project.destroy', ['project' => $this->project]));
        $response->assertRedirect(route('admin.project.index'));
        $this->assertSoftDeleted($this->project);
    }

    /**
     * A basic test of preview
     *
     * @return void
     */
    public function test_preview()
    {
        $this->project->save();
        $this->project->plans()->saveMany(Plan::factory(5));
        $response = $this->actingAs($this->admin, 'admin')->from(route('admin.project.index'))->get(route('admin.project.preview', ['project' => $this->project]));
        $response->assertOk();
        $response->assertViewIs('admin.project.preview');
    }
}
