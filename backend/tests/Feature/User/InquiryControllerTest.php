<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class InquiryControllerTest extends TestCase
{
    use RefreshDatabase;

    Public function setUp(): void
    {
        parent::setUp();

        // $this->user = User::factory()->create();
    }

    public function testCreateInquiry()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('user.inquiry.create'));
        $response->assertOk()
                 ->assertViewIs('user.mail.inquiry.create_inquiry')
                 ->assertViewHas("inquiry_categories");
    }
}
