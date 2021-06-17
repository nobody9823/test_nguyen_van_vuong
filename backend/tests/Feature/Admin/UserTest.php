<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->admin = Admin::create([
            'name' => 'admin',
            'email' => 'test@valleyin.co.jp',
            'password' => 'admin',
        ]);
        $this->user = User::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->actingAs($this->admin, 'admin')->get('admin/user');
        $response->assertStatus(200)->assertViewIs('admin.user.index'); //最低限viewのみ確認
    }

    public function test_create()
    {
        $response = $this->actingAs($this->admin, 'admin')->get('admin/user/create');
        $response->assertStatus(200)->assertViewIs('admin.user.create'); //最低限viewのみ確認
    }

    public function test_store()
    {
        $response = $this->actingAs($this->admin, 'admin')->post('admin/user', [
            'name'=>'created@name',
            'email'=>'created@email',
            'password'=>'created@password',
            'password_confirmation'=>'created@password'
        ]);
        $response->assertRedirect('admin/user');

        //データが存在するかの確認
        $this->assertDatabaseHas('users', [
            'name' => 'created@name',
            'email' => 'created@email'
        ]);
    }

    public function test_edit()
    {
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.user.edit', ['user' => $this->user]));
        $response->assertStatus(200)->assertViewIs('admin.user.edit'); //最低限viewのみ確認
    }

    public function test_update()
    {
        $response = $this->actingAs($this->admin, 'admin')->put(route('admin.user.update', ['user' => $this->user]), [
            'name'=>'updated@name',
            'email'=>'updated@email',
        ]);
        $response->assertRedirect('/admin/user');
        //データが存在するかの確認
        $this->assertDatabaseHas('users', [
            'name' => 'updated@name',
            'email' => 'updated@email'
        ]);
    }

    public function test_destroy()
    {
        $response = $this->actingAs($this->admin, 'admin')->delete(route('admin.user.destroy', ['user' => $this->user]));
        $response->assertRedirect('admin/user');
        //データが論理削除されたか確認
        $this->assertSoftDeleted($this->user);
    }

    public function test_search()
    {
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.user.search', ['word' => $this->user->name]));
        $response->assertStatus(200)
        ->assertViewIs('admin.user.index')
        ->assertSeeText($this->user->name);
    }
}
