<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Faker\Factory;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

class ProjectRequestTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $url = "admin/project/create";

        $method = 'POST';

        $this->request = Request::create($url, $method);
    }
    /**
     * test for Project Request
     *
     * @param array
     * @param array
     * @param boolean
    * @dataProvider dataProjectRequest
    */
    public function testProjectRequest(array $keys, array $values, bool $expect)
    {
        $this->actingAs($this->admin, 'admin');

        $dataList = array_combine($keys, $values);

        $rules = (new ProjectRequest())->rules($this->request);

        $validator = Validator::make($dataList, $rules);

        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataProjectRequest()
    {
        $faker = Factory::create( Factory::DEFAULT_LOCALE);

        return [
            'OK' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                true
            ],
            'category_id.required' => [
                ['title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'category_id.integer' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    'text',
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'title.required' => [
                ['category_id', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'title.string' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    1,
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'title.max' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 46),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'greeting_and_introduce.required' => [
                ['category_id', 'title', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'greeting_and_introduce.string' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    1,
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'greeting_and_introduce.max' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5001),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'explanation.required' => [
                ['category_id', 'title', 'greeting_and_introduce', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'explanation.string' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    1,
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'explanation.max' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5001),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'opportunity.required' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'opportunity.string' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    1,
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'opportunity.max' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5001),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'finally.required' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'finally.string' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    1,
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'finally.max' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5001),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'target_amount.required' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'target_amount.integer' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    'text',
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'target_amount.max' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    100000000,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'talent_id.required' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'talent_id.integer' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    'text',
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'start_date.required' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'start_date.date_format' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'start_date.after_1_week' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->date('Y-m-d H:i:s', 'now'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'end_date.required' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'end_date.date_format' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'end_date.date_format' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->date('Y-m-d H:i:s', '+2week'),
                    $faker->date('Y-m-d H:i:s', '+2week'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'images.required' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'images.less_than_10' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
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
                        UploadedFile::fake()->image('dummy1.png'),
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'images.image' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.pict')
                    ),
                    'https://www.youtube.com/watch?v=C0DPdy98e4c'
                ],
                false
            ],
            'video_url.nullable' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    )
                ],
                true
            ],
            'video_url.url' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'text'
                ],
                false
            ],
            'video_url.regex' => [
                ['category_id', 'title', 'greeting_and_introduce', 'explanation', 'opportunity', 'finally', 'target_amount', 'talent_id', 'start_date', 'end_date', 'images', 'video_url'],
                [
                    1,
                    str_repeat('a', 45),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    str_repeat('a', 5000),
                    99999999,
                    1,
                    $faker->dateTimeBetween('+2week', '+3week')->format('Y-m-d H:i:s'),
                    $faker->dateTimeBetween('+4week', '+5week')->format('Y-m-d H:i:s'),
                    array(
                        UploadedFile::fake()->image('dummy1.png')
                    ),
                    'https://www.youtube.com'
                ],
                false
            ],
        ];
    }
}
