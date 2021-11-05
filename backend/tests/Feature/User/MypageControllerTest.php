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

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->has(SnsLink::factory())
            ->has(Address::factory())
            ->has(Profile::factory())
            ->has(
                Project::factory()
                    ->has(Plan::factory())
                    ->has(
                        Payment::factory()->state(['payment_is_finished' => true])
                            ->has(PaymentToken::factory())
                    )
            )->create();

        $this->project = $this->user->projects()->first();

        $this->plan = $this->project->plans()->first();

        $this->payment = $this->project->payments()->first();

        $this->payment->includedPlans()->attach($this->plan->id, ['quantity' => 1]);

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
            ->assertViewHas(['payments', 'project']);
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
            ->patch(route('user.update_profile', ['user' => $this->user]), $this->data);
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

    public function testDeleteUser()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
            ->from(route('user.withdraw'))
            ->delete(route('user.delete_user', ['user' => $this->user]));
        $response->assertRedirect(route('user.index'));
        $this->assertSoftDeleted($this->user);
        $this->assertEquals(0, User::count());
    }

    // TODO:将来的にサポートプランを実装する場合に用いる
    // public function testCommission()
    // {
    //     $this->withoutExceptionHandling();

    //     $response = $this->from(route('user.index'))
    //                      ->get(route('user.commission'));
    //     $response->assertOk()
    //              ->assertViewIs('user.commission');
    // }

    public function testPsTermsOfService()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->from(route('user.index'))
            ->get(route('user.ps_terms_of_service'));
        $response->assertOk()
            ->assertViewIs('user.footer.ps_terms_of_service');
    }

    public function testTermsOfService()
    {
        $this->withoutExceptionHandling();

        $response = $this->from(route('user.index'))
            ->get(route('user.terms_of_service'));
        $response->assertOk()
            ->assertViewIs('user.footer.terms_of_service');
    }

    public function testPrivacyPolicy()
    {
        $this->withoutExceptionHandling();

        $response = $this->from(route('user.index'))
            ->get(route('user.privacy_policy'));
        $response->assertOk()
            ->assertViewIs('user.footer.privacy_policy');
    }

    public function testTradeLaw()
    {
        $this->withoutExceptionHandling();

        $response = $this->from(route('user.index'))
            ->get(route('user.trade_law'));
        $response->assertOk()
            ->assertViewIs('user.footer.trade_law');
    }

    public function testQuestion()
    {
        $this->withoutExceptionHandling();

        $response = $this->from(route('user.index'))
            ->get(route('user.question'));
        $response->assertOk()
            ->assertViewIs('user.footer.question');
    }
}
