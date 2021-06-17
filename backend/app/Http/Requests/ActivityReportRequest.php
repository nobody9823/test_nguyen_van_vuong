<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ActivityReportImage;
use App\Rules\ActivityReportImages;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ActivityReportRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'max:55'],
            'content' => ['required', 'string', 'max:2000'],
            'images' => [Rule::requiredIf($request->isMethod('post')), new ActivityReportImages($request)],
            'images.*' => ['image'],
        ];
    }

    public function messages(){
        return [
            'title.required' => "タイトルを入力してください。",
            'title.string' => "タイトルは文字で入力してください。",
            'title.max' => "タイトルは255文字以内にしてください。",
            'content.required' => '内容を入力してください。',
            'content.string' => '内容は文字で入力してください。',
            'content.max' => '内容は20000文字以内にしてください。',
            'images.required' => "画像は必須項目です。",
            'images.*.image' => "画像の形式が不正です。ご確認下さい。(jpg、jpeg、png、bmp、gif、svg、webp)",
        ];
    }

    /**
     * Return request array that is merged with project id
     *@param int
     *
     *@return array
     */
    public function fillWithProjectId($project_id): array
    {
        $project_id_array = array("project_id" => $project_id);

        return array_merge($this->all(), $project_id_array);
    }

    /**
     * Return request array of images
     *
     * @return array
     */
    public function imagesToArray(): array
    {
        $imagesArray = [];
        $data = $this->all();

        if ($this->file('images') !== null){
            foreach($data['images'] as $image){
                $imagesArray[]
                        = new ActivityReportImage([
                                'image_url' => $image
                            ]);
            }
        }
        return $imagesArray;
    }
}
