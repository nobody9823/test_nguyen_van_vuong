<?php

namespace Tests\Unit\Helpers;

use App\Models\Admin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\DisplayVideoHelper;

class DisplayVideoHelperTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
        $this->url = 'https://www.youtube.com/watch?v=C0DPdy98e4c';
    }

    public function testGetVideoAtManageIsSuccess()
    {
        $this->actingAs($this->admin);
        ob_start();
        DisplayVideoHelper::getVideoAtManage($this->url);
        $actual = ob_get_clean();
        $this->assertSame('<div class="embed-responsive embed-responsive-1by1"><iframe width="600" height="338" src="https://www.youtube.com/embed/C0DPdy98e4c" frameborder="0" class="pt-4" allowfullscreen></iframe></div>', $actual);
    }

    public function testGetVideoAtManageIsFail()
    {
        $this->actingAs($this->admin);
        ob_start();
        DisplayVideoHelper::getVideoAtManage("");
        $actual = ob_get_clean();
        $this->assertSame("", $actual);
    }

    public function testGetVideoAtUserIsSuccess()
    {
        $this->actingAs($this->admin);
        ob_start();
        DisplayVideoHelper::getVideoAtUser($this->url);
        $actual = ob_get_clean();
        $this->assertSame('<div style="position:relative; width:100%; height:0; padding-top:25%;"><iframe width="600" height="338" src="https://www.youtube.com/embed/C0DPdy98e4c" frameborder="0" class="pt-4" allowfullscreen style="position:absolute; top:0; left:0; width:100%; height:100%;"></iframe></div>', $actual);
    }

    public function testGetVideoAtUserIsFail()
    {
        $this->actingAs($this->admin);
        ob_start();
        DisplayVideoHelper::getVideoAtUser("");
        $actual = ob_get_clean();
        $this->assertSame('', $actual);
    }

    public function testGetThumbnailIsSuccess()
    {
        $this->actingAs($this->admin);
        ob_start();
        DisplayVideoHelper::getThumbnail($this->url);
        $actual = ob_get_clean();
        $this->assertSame('<img src="https://img.youtube.com/vi/C0DPdy98e4c/default.jpg" />', $actual);
    }

    public function testGetThumbnailIsFail()
    {
        $this->actingAs($this->admin);
        ob_start();
        DisplayVideoHelper::getThumbnail("");
        $actual = ob_get_clean();
        $this->assertSame('', $actual);
    }
}
