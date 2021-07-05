<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Request;

class ProfileRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $expire_date = Carbon::now()->format('Y-m-d');
        return [
            'image_url' =>['nullable', 'image'],
            'first_name_kana' =>['required', 'string'],
            'last_name_kana' =>['required', 'string'],
            'first_name' =>['required', 'string'],
            'last_name' =>['required', 'string'],
            'birthday' => ['required', 'date_format:Y-m-d',"after:{$expire_date}"],
            'birthday_is_published' =>['nullable', 'integer'],
            'gender' =>['required', 'string'],
            'gender_is_published' =>['nullable', 'integer'],
            'introduction' =>['required', 'string'],
            'phone_number' =>['required', 'string'],
        ];
    }
}
