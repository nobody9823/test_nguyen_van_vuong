<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\MailFromInquiry;

class InquiryControllerTest extends TestCase
{
    use RefreshDatabase;

    Public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testCreateInquiry()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('user.inquiry.create'));
        $response->assertOk()
                 ->assertViewIs('user.mail.inquiry.create_inquiry')
                 ->assertViewHas("inquiry_categories");
    }

    public function testSendInquiry()
    {
        $this->withoutExceptionHandling();

        // メールのテストデータ
        $inquiry = [
            "name" => $this->user->name,
            "email" => $this->user->email,
            "inquiry_category" => "プロジェクト掲載の相談",
            "device_type" => "pc",
            "project_page_name" => "プロジェクト名",
            "title" => "問い合わせ件名",
            "content" => "問い合わせ内容",
        ];
        // 送信先のメールアドレス
        $mail_address = config('mail.customer_support.address');

        // 実際にはメールを送信しない処理
        Mail::fake();

        Mail::assertNothingSent();

        // メール送信処理のテスト
        $response = $this->from(route('user.inquiry.create'))
                         ->post(route('user.inquiry.send', $inquiry));

        // メールが指定したユーザーに届いた事を確認
        Mail::assertSent(MailFromInquiry::class, function ($mail) use ($mail_address) {
            return $mail->hasTo($mail_address);
        });
        
        // メールが1回送信されたことを確認
        Mail::assertSent(MailFromInquiry::class, 1);
    }
}
