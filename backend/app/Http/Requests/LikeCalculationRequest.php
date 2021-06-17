<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LikeCalculationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'add_point' => 'integer',
            'sub_point' => ['bail', 'integer',
                function ($attribute, $value, $fail) {
                    if ($this->route('project')->total_likes - $value < 0) {
                        $fail('いいね数は0以上で設定してください');
                    }
                }
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => '422 Unprocessable Entity',
                'errors' => $validator->errors()->toArray(),
                'result' => 'failed',
                'total_likes' => $this->route('project')->total_likes,
            ], 422)
        );
    }
}
