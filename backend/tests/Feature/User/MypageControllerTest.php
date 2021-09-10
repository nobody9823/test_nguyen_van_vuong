<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\SnsLink;
use App\Models\Profile;
use App\Models\Address;
use App\Models\Project;
use App\Models\Payment;
use App\Models\PaymentToken;
use App\Models\Plan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MypageControllerTest extends TestCase
{
    use RefreshDatabase;

    Public function setUp(): void
    {
        parent::setUp();

        // ダミーデータの記述方法を後で変更する（楠本の個人的なメモです）
        $this->user = User::factory()->create();

        $this->sns_link = SnsLink::factory()->state([
            'user_id' => $this->user->id,            
        ])->create();

        $this->profile = Profile::factory()->state([
            'user_id' => $this->user->id,
        ])->create();

        $this->address = Address::factory()->state([
            'user_id' => $this->user->id,
        ])->create();

        $this->project = Project::factory()->state([
            'user_id' => $this->user->id,
        ])->create();

        $this->payment = Payment::factory()->state([
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ])->create();

        $this->plan = Plan::factory()->state([
            'project_id' => $this->project->id,
        ])->create();

        $this->payment_token = PaymentToken::factory()->state([
            'payment_id' => $this->payment->id,            
        ])->create();

        $this->payment->includedPlans()->attach($this->plan->id ,['quantity' => 1]);

        $this->data =
        [
        "name" => "山田 太郎",
        "image_url" => UploadedFile::fake()->image('avatar.jpeg'),
        "email" => "test@valleyin.co.jp",
        "email_confirmation" => "test@valleyin.co.jp",
        "password" => "test1234",
        "password_confirmation" => "test1234",
        "twitter_url" => "https://twitter.com/",
        "instagram_url" => "https://www.instagram.com/",
        "youtube_url" => "https://www.youtube.com/",
        "tiktok_url" => "https://www.tiktok.com/",
        "other_url" => "https://readouble.com/",
        "prefecture" => "東京都", 
        "year" => "2011",
        "month" => "1",
        "day" => "1",
        "birthday_is_published" => "1",
        "gender" => "男性",
        "gender_is_published" => "1",
        "introduction" => "自己紹介文",
        ]; 
    }

    public function testPaymentHistory()
    {
        $this->withoutExceptionHandling(); 

        $response = $this->actingAs($this->user)
                         ->from(route('user.profile'))
                         ->get(route('user.payment_history'));
        $response->assertOk()
                 ->assertViewIs('user.mypage.payment')
                 ->assertViewHas(['payments' ,'project']);
    }

    public function testContributionComments()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.profile'))
                         ->get(route('user.contribution_comments'));
        $response->assertOk()
                 ->assertViewIs('user.mypage.comment')
                 ->assertViewHas('comments');
    }
    
    public function testPurchasedProjects()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.profile'))
                         ->get(route('user.purchased_projects'));
        $response->assertOk()
                 ->assertViewIs('user.mypage.project')
                 ->assertViewHas('projects');
    }

    public function testLikedProjects()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.profile'))
                         ->get(route('user.liked_projects'));
        $response->assertOk()
                 ->assertViewIs('user.mypage.liked_project')
                 ->assertViewHas(['projects', 'user_liked']);
    }

    public function testProfile()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
                         ->from(route('user.index'))
                         ->get(route('user.profile'));
        $response->assertOk()
                 ->assertViewIs('user.mypage.profile')
                 ->assertViewHas('user');
    }

    public function testUpdateProfile()
    {
        $this->withoutExceptionHandling();
        Storage::fake('avatars');

        $response = $this->actingAs($this->user)
                         ->from(route('user.profile'))
                         ->patch(route('user.update_profile',['user' => $this->user]), $this->data);
        $response->assertRedirect(route('user.profile'));
    }

    public function testWithdraw()
    {
        $this->withoutExceptionHandling(); 

        $response = $this->actingAs($this->user)
                         ->from(route('user.profile'))
                         ->get(route('user.withdraw'));
        $response->assertOk()
                 ->assertViewIs('user.mypage.withdraw');
    }
}
