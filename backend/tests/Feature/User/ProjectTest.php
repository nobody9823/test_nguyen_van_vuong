<?php

namespace Tests\Feature\User;

use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->users = User::factory()
            ->has(Profile::factory())
            ->has(Project::factory()->released()->has(
                ProjectFile::factory()
            ))
            ->count(10)->create();
    }

    public function testIndexAction()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    public function testShowAction()
    {
        $response = $this->actingAs($this->users->first())
            ->get(route('user.project.show', ['project' => Project::first()]));
        $response->assertOk();
    }

    public function testSearchAction()
    {
        $response = $this->get(route('user.search'));
        $response->assertOk();
    }
}
