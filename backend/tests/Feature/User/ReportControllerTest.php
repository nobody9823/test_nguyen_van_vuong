<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Project;
use App\Models\Report;
use Tests\TestCase;

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
            'project_id' => $this->project->id
        ])->count(3)->create();
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
}
