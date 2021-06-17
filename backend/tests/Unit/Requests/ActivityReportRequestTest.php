<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\ActivityReportRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Project;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;

class ActivityReportRequestTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->project = Project::factory()->create();

        $url = "admin/project/{$this->project->id}/activity_report";

        $method = "POST";

        $this->request = Request::create($url, $method);
    }

    /**
     * test for Plan Request
     *
     * @param array
     * @param array
     * @param boolean
    * @dataProvider dataActivityReportRequest
    */
    public function testActivityReportTest(array $keys, array $values, bool $expect)
    {
        $this->actingAs($this->admin, "admin");

        $dataList = array_combine($keys, $values);

        $rules = (new ActivityReportRequest())->rules($this->request);

        $validator = Validator::make($dataList, $rules);

        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataActivityReportRequest()
    {
        return [
            'OK' => [
                ['title', 'content', 'images'],
                [
                    str_repeat('a', 55),
                    str_repeat('a', 2000),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    )
                ],
                true
            ],
            'title.required' => [
                ['content', 'images'],
                [
                    str_repeat('a', 2000),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    )
                ],
                false
            ],
            'title.string' => [
                ['title', 'content', 'images'],
                [
                    1,
                    str_repeat('a', 2000),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    )
                ],
                false
            ],
            'title.max' => [
                ['title', 'content', 'images'],
                [
                    str_repeat('a', 56),
                    str_repeat('a', 2000),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    )
                ],
                false
            ],
            'content.required' => [
                ['title', 'images'],
                [
                    str_repeat('a', 55),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    )
                ],
                false
            ],
            'content.string' => [
                ['title', 'content', 'images'],
                [
                    str_repeat('a', 55),
                    1,
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    )
                ],
                false
            ],
            'content.max' => [
                ['title', 'content', 'images'],
                [
                    str_repeat('a', 55),
                    str_repeat('a', 2001),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    )
                ],
                false
            ],
            'images.required' => [
                ['title', 'content', 'images'],
                [
                    str_repeat('a', 55),
                    str_repeat('a', 2000),
                    array(
                    )
                ],
                false
            ],
            'images.image' => [
                ['title', 'content', 'images'],
                [
                    str_repeat('a', 55),
                    str_repeat('a', 2000),
                    array(
                        UploadedFile::fake()->image('dummy1.pict')
                    )
                ],
                false
            ],
            'images.less_than_10' => [
                ['title', 'content', 'images'],
                [
                    str_repeat('a', 55),
                    str_repeat('a', 2000),
                    array(
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png'),
                        UploadedFile::fake()->image('dummy1.png')
                    )
                ],
                false
            ],
        ];
    }
}
