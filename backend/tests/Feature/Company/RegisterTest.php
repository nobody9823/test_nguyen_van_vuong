<?php

namespace Tests\Feature\Company;

use App\Mail\Company\RegisterFinished;
use App\Models\EmailVerification;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp():void
    {
        parent::setUp();

        Mail::fake();
        Storage::fake('local');
        Log::spy();

        $this->email = 'test_email@test.com.com';
        $this->email_verification = EmailVerification::create([
            'email' => 'test@test.com',
            'token' => 10000000000000,
            'status' => 0,
            'expiration_datetime' => Carbon::now()->addHours(1),
        ]);

        $this->data = [
            'name' => 'test user',
            'password' => 'test1111', // password
            'password_confirmation' => 'test1111', // password
            'office_address' => $this->faker->address,
            'phone_number' => '111-1111-1111',
            'certificate_files' => [
                0 => UploadedFile::fake()->image('test.jpg'),
                1 => UploadedFile::fake()->image('test.jpg'),
                2 => UploadedFile::fake()->image('test.jpg'),
            ],
            'recognition_of_service' => $this->faker->title,
            'bank_name' => $this->faker->lastName.'銀行',
            'bank_branch_name' => $this->faker->lastName.'支店',
            'bank_account_number' => '1111111111111111',
            'bank_account_holder' => 'AAA AAA',
        ];
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPreCreateAction()
    {
        $response = $this->get('company/pre_create');

        $response->assertStatus(200);
    }

    public function testPreRegisterAction()
    {
        $response = $this->post('company/pre_register', ['email' => $this->email]);

        $response->assertStatus(200)->assertViewIs('company.pre_registered'); //validationに引っかからず正しく200が返ってきているか
        $this->assertDatabaseHas('email_verifications', [
            'email' => $this->email,
        ]); //保存されているか
    }
    /**
     * test for Create Action
     *
    * @dataProvider dataCreateAction
    */
    public function testCreateAction($token, $response_status, $verified_status)
    {
        $response = $this->get(route('company.create', ['token' => $token]));

        $response->assertStatus($response_status);

        $this->assertDatabaseHas('email_verifications',[
            'id' => $this->email_verification->id,
            'status' => $verified_status,
        ]);
    }

    public function dataCreateAction()
    {
        return [
            'success' => [
                10000000000000,
                200,
                1,
            ],
            'invalid token sent' => [
                99999999999999,
                302,
                0,
            ],
        ];
    }

    public function testStoreActionCaseOfSuccess()
    {
        $response = $this->post(route('company.register',['token' => $this->email_verification->token]), $this->data);

        Mail::assertSent(RegisterFinished::class);
        $response->assertRedirect(route('company.register_finished'));
        $this->assertDatabaseHas('temporary_companies',[
            'email' => 'test@test.com',
        ]);
    }

    public function testStoreActionCaseOfInvalidToken()
    {
        $response = $this->post(route('company.register',['token' => 9999999999]), $this->data);

        Mail::assertNotSent(RegisterFinished::class);
        $response->assertRedirect(route('company.pre_create'));
        $this->assertDatabaseMissing('temporary_companies', [
            'email' => 'test@test.com',
        ]);
    }
}
