<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class InquiryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInquiryCreate()
    {
        $response = $this->get(route('user.inquiry.create'));

        $response->assertStatus(200);
    }

    public function testInquirySend()
    {
        // 後で実装します。
    }
}
