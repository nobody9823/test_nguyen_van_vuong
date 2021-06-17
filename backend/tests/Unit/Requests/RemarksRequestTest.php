<?php

namespace Tests\Unit\Requests;

use App\Models\Admin;
use App\Http\Requests\RemarksRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemarksRequestTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
    }

    /**
     * test for Plan Request
     *
     * @param array
     * @param array
     * @param boolean
    * @dataProvider dataRemarksRequest
    */
    public function testRemarksRequest(array $keys, array $values, bool $expect)
    {
        $this->actingAs($this->admin, 'admin');

        $dataList = array_combine($keys, $values);

        $rules = (new RemarksRequest())->rules();

        $validator = Validator::make($dataList, $rules);

        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataRemarksRequest()
    {
        return [
            'OK' => [
                ['remarks'],
                [
                    str_repeat('a', 100)
                ],
                true
            ],
            'remarks.nullable' => [
                [],
                [],
                true
            ],
            'remarks.string' => [
                ['remarks'],
                [
                    1
                ],
                false
            ],
            'remarks.max' => [
                ['remarks'],
                [
                    str_repeat('a', 1001)
                ],
                false
            ],
        ];
    }
}