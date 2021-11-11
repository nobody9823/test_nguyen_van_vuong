<?php

namespace App\Http\Requests;

use App\Rules\AlterTran;
use Illuminate\Foundation\Http\FormRequest;

class AlterTranRequest extends FormRequest
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
            'project' => ['required', 'exists:projects,id', new AlterTran($this->input('project'))],
            'payments' => 'required|array',
            'payments.*' => 'exists:payments,id',
        ];
    }

    public function messages()
    {
        return [
            'project.required' => 'プロジェクトを指定してください。',
            'project.exists' => 'プロジェクトが存在しません。',
            'payments.required' => '決済を指定してください。',
            'payments.array' => '決済が正しく選択されていません。',
            'payments.*.exists' => '選択されている決済に存在しないものが含まれています。',
        ];
    }
}
