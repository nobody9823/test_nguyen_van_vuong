<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Report;
use App\Models\Payment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ReportControllerTest extends TestCase
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

        $this->report = Report::factory()->state([
            'project_id' => $this->project->id,
            'image_url' => UploadedFile::fake()->image('avatar.jpeg')
        ])->create(); 

        $this->payment = Payment::factory()->state([
            'user_id' => $this->user,
            'project_id' => $this->project->id
        ])->create();

        $this->data = 
        [
            'project_id' => $this->report->project_id,
            'title' => $this->report->title,
            'content' => $this->report->content,
            'image_url' => UploadedFile::fake()->image('avatar.jpeg')
        ];

        $this->data_for_delete = array_merge($this->data, array('delete'=>'delete'));
    }


    public function testIndexAction()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.my_project.project.show', ['project' => $this->project]))
                         ->get(route('user.report.index', ['project' => $this->project]));
        $response->assertOk()
                 ->assertViewIs('user.report.index')
                 ->assertViewHas(['reports','project']);
    }

    public function testCreateAction()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.report.index', ['project' => $this->project]))
                         ->get(route('user.report.create', ['project' => $this->project]));
        $response->assertOk()
                 ->assertViewIs('user.report.create')
                 ->assertViewHas('project');
    }

    public function testStoreAction()
    {
        $this->withoutExceptionHandling();
        Storage::fake('avatars');
        
        $response = $this->actingAs($this->user)
                         ->from(route('user.report.create', ['project' => $this->project]))
                         ->post(route('user.report.store', ['project' => $this->project]), $this->data);
        $response->assertRedirect(route('user.report.index', ['project' => $this->project]));
    }

    public function testShowAction()
    {
        $this->withoutExceptionHandling();
 
        $response = $this->actingAs($this->user)
                         ->from(route('user.project.show', ['project' => $this->project]))
                         ->get(route('user.report.show', ['project' => $this->project, 'report' => $this->report]));
        $response->assertOk()
                 ->assertViewIs('user.report.show')
                 ->assertViewHas(['project','report']);
    }

    public function testEditAction()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.report.index', ['project' => $this->project]))
                         ->get(route('user.report.edit', ['project' => $this->project, 'report' => $this->report]));
        $response->assertOk()
                 ->assertViewIs('user.report.edit')
                 ->assertViewHas(['project','report']);
    }

    public function testUpdateActionForUpdate()
    {
        $this->withoutExceptionHandling();
        Storage::fake('avatars');

        $response = $this->actingAs($this->user)
                         ->from(route('user.report.edit', ['project' => $this->project, 'report' => $this->report]))
                         ->put(route('user.report.update', ['project' => $this->project, 'report' => $this->report]),$this->data);
        $response->assertRedirect(route('user.report.index', ['project' => $this->project]));
    }
    
    public function testUpdateActionForDelete()
    {
        $this->withoutExceptionHandling();
        Storage::fake('avatars');

        $response = $this->actingAs($this->user)
                         ->from(route('user.report.edit', ['project' => $this->project, 'report' => $this->report]))
                         ->put(route('user.report.update', ['project' => $this->project, 'report' => $this->report]),
                         $this->data_for_delete);
        $response->assertRedirect(route('user.report.index', ['project' => $this->project]));
        $this->assertSoftDeleted($this->report)
             ->assertEquals(0, Report::count());
    }
}
