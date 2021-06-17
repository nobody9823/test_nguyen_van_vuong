<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\PlanRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Project;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;

class PlanRequestTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->project = Project::factory()->create();

        $url = "admin/project/{$this->project->id}/plan";

        $method = 'POST';

        $this->request = Request::create($url, $method);
    }

    /**
     * test for Plan Request
     *
     * @param array
     * @param array
     * @param boolean
    * @dataProvider dataPlanRequest
    */
    public function testPlanRequest(array $keys, array $values, bool $expect)
    {
        $this->actingAs($this->admin, "admin");

        $dataList = array_combine($keys, $values);

        $rules = (new PlanRequest())->rules($this->request);

        $validator = Validator::make($dataList, $rules);

        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataPlanRequest()
    {
        $faker = Factory::create( Factory::DEFAULT_LOCALE);

        return [
            'OK' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                true
            ],
            'name.required' => [
                ['content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'name.string' => [
                ['name', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    1,
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'name.max' => [
                ['name', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 46),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'content.required' => [
                ['name', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'content.string' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    1,
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'content.max' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2001),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'estimated_return_date.required' => [
                ['title', 'content', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'estimated_return_date.date_format' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d H:i:s'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'estimated_return_date.after' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->date('Y-m-d', 'now'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'price.required' => [
                ['title', 'content', 'estimated_return_date', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'price.integer' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    'test',
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'price.min' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    499,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'price.max' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    10000001,
                    UploadedFile::fake()->image('dummy1.png'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'image.nullable' => [
                ['title', 'content', 'estimated_return_date', 'price', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    array(
                        $faker->realText(20)
                    )
                ],
                true
            ],
            'image.image' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image', 'options'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    UploadedFile::fake()->image('dummy1.pict'),
                    array(
                        $faker->realText(20)
                    )
                ],
                false
            ],
            'options.nullable' => [
                ['title', 'content', 'estimated_return_date', 'price', 'image'],
                [
                    str_repeat('a', 45),
                    str_repeat('a', 2000),
                    $faker->dateTimeBetween('+1day', '+1year')->format('Y-m-d'),
                    1000,
                    UploadedFile::fake()->image('dummy1.png'),
                ],
                true
            ]
        ];
    }
}
