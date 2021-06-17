<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Project;
use Artisan;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectTest extends TestCase
{
    // use RefreshDatabase;

    // protected $user;

    // protected $data;

    // public function setUp() :void
    // {
    //     parent::setUp();
    //     Artisan::call('migrate:refresh');
    //     Artisan::call('db:seed');
    //     $this->user = Admin::first();
    //     $this->project = Project::first();
    //     Storage::fake('testing');
    //     $this->data =  [
    //         'title' => "test",
    //         'explanation' => "test",
    //         'target_amount' => 100000,
    //         'talent_id' => 1,
    //         'start_date' => Carbon::tomorrow()->format('Y-m-d H:i:s'),
    //         'end_date' => Carbon::parse('+1 month')->endOfMonth()->format('Y-m-d H:i:s'),
    //         'category_id' => 1,
    //         'is_released' => 0,
    //         'images' => array(
    //             UploadedFile::fake()->image('dummy1.png'),
    //             UploadedFile::fake()->image('dummy2.png'),
    //             UploadedFile::fake()->image('dummy3.png'),
    //         )
    //     ];
    // }
    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testAccessToAdminProjectIndexPage()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->get(route('admin.project.index'));

    //     $response->assertStatus(200)
    //                 ->assertSee('プロジェクト一覧');
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testAccessToAdminProjectCreatePage()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->get(route('admin.project.create'));

    //     $response->assertStatus(200)
    //                 ->assertSee('新規プロジェクト追加');
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testCreateProjectByAdmin()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->post(route('admin.project.store', $this->data));
    //     $project = Project::where("title", 'like', 'test')->first();

    //     $response->assertRedirect(route('admin.plan.create', $project))
    //                 ->assertSessionHas('flash_message', 'プロジェクト作成が成功しました。プランを作成してください。');
    //     foreach($project->projectImages as $image){
    //         Storage::disk('testing')->assertExists($image->image_url);
    //     }
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testAccessToAdminProjectShowPage()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->get(route('admin.project.show', $this->project));

    //     $response->assertStatus(200)
    //                 ->assertSee('プロジェクト詳細');
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testAccessToAdminProjectEditPage()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->get(route('admin.project.edit', $this->project));

    //     $response->assertStatus(200)
    //                 ->assertSee('プロジェクト編集画面');
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testEditProjectByAdmin()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->put(route('admin.project.update', $this->project), $this->data);

    //     $response->assertRedirect(route('admin.project.index'))
    //                 ->assertSessionHas('flash_message', '更新が成功しました。');
    //     foreach($project->projectImages as $image){
    //         Storage::disk('testing')->assertExists($image->image_url);
    //     }
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testAccessToAdminProjectPreviewPage()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->get(route('admin.project.preview', $this->project));

    //     $response->assertStatus(200)
    //                 ->assertSee('みんなのチカラでアイドルを救え');
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testDestroyProjectImageByAdmin()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->deleteJson(route('admin.project.image', $this->project->projectImages->first()));

    //     $response->assertStatus(200);
    //     $this->assertEquals($response->getData(), 'success');
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testDestroyProjectByAdmin()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->delete(route('admin.project.destroy', $this->project));

    //     $response->assertRedirect(route('admin.project.index'))
    //                 ->assertSessionHas('flash_message', '削除が成功しました。');
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testSearchProjectsByAdmin()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->post(route('admin.project.search', [
    //                             "word" => "test"
    //                         ]));

    //     $response->assertStatus(200)
    //                 ->assertSee('test の検索結果');
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testReleaseProjectByAdmin()
    // {
    //     $this->withoutExceptionHandling();
    //     $project = Project::where('is_released', false)->first();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->getJson(route('admin.project.release', $project));

    //     $response->assertStatus(200);
    //     $this->assertEquals($response->getData(), 'success');
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testGetCsvOfProjectDataByAdmin()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->actingAs($this->user, 'admin')
    //                         ->get(route('admin.project.output_cheering_users_to_csv', $this->project));

    //     $project_title = $this->project->title;
    //     $response->assertStatus(200)
    //                 ->assertHeader('Content-Type', 'text/csv; charset=UTF-8')
    //                 ->assertHeader('Content-Disposition', "attachment; filename=cheering_user_list_${project_title}.csv");
    // }
}
