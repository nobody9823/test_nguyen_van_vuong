<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\ProjectImage;
use App\Models\ProjectVideo;
use App\Rules\ProjectImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use DateTime;

class ProjectRequest extends FormRequest
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
        // プロジェクト開始から終了までの期間は上限60日までしか設定出来ない。
        $start_date = new DateTime($request->start_date);
        $end_date_limit = ($start_date->modify("+60 day"))->format('Y-m-d H:i:s');

        return [
            'category_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:45'],
            'greeting_and_introduce' => ['required', 'string', 'max:5000'],
            'explanation' => ['required', 'string', 'max:5000'],
            'opportunity' => ['required', 'string', 'max:5000'],
            'finally' => ['required', 'string', 'max:5000'],
            'target_amount' => ['required', 'integer', 'max:99999999'],
            // タレント画面でプロジェクト作成をする時のみ、タレントidのバリデーションは実行しない。
            'talent_id' => ['integer',Rule::requiredIf(!$request->is('talent/*'))],
            'start_date' => ['required', 'date_format:Y-m-d H:i:s', $request->isMethod('post') ?'after:1 week':null],
            'end_date' => ['required', 'date_format:Y-m-d H:i:s', 'after:start_date', "before:{$end_date_limit}"],
            'images' => [Rule::requiredIf($request->isMethod('post')), new ProjectImages($request)],
            'images.*' => ['image'], //images配列の中身を見る
            'video_url' => ['nullable', 'url', 'regex:#(https?://www.youtube.com/.*)(v=([-\w]{11}))#'],
        ];
    }

    // requestのImagesから、ProjectImageインスタンスの配列変数として返す
    public function imagesToArray():array
    {
        $projectImages = array();
        $data = $this->all();

        if ($this->file('images') !== null) {
            foreach ($data['images'] as $image) {
                $projectImages[] = new ProjectImage([
                    'image_url' => $image
                ]);
            }
        }
        return $projectImages;
    }

    public function allWithCompanyId()
    {
        return array_merge($this->all(), array('company_id' => Auth::id()));
    }

    public function allWithTalentId()
    {
        if (strpos(url()->previous(), 'talent') !== false) {
            return array_merge($this->all(), array('talent_id' => Auth::id()));
        }

        return $this->all();
    }

    public function projectVideo()
    {
        if ($this->all()['video_url'] !== null){
            return new ProjectVideo([
                'video_url' => $this->all()['video_url']
            ]);
        }
        return null;
    }

    public function messages()
    {
        return [
            'category_id.required' => "カテゴリーを入力してください。",
            'category_id.integer' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
            'talent_id.required' => "タレントを指定してください",
            'talent_id.integer' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
            'title.required' => "タイトルを入力してください。",
            'title.string' => "タイトルは文字で入力してください。",
            'title.max' => "タイトルは255文字以内にしてください。",
            'explanation.required' => "プロジェクト内容を入力してください。",
            'explanation.string' => "プロジェクト内容は文字で入力してください。",
            'explanation.max' => "プロジェクト内容は20000文字以内にしてください。",
            'target_amount.required' => "目標金額を入力してください。",
            'target_amount.integer' => "目標金額は数字で入力してください。",
            'target_amount.max' => "目標金額は99,999,999円以内にしてください。",
            'start_date.required' => "掲載開始日時を入力してください。",
            'start_date.date_format' => "掲載開始日時の形式を確認してください。",
            'start_date.after' => "掲載開始日時を現在より1週間後にしてください",
            'end_date.required' => "掲載終了日時を入力してください。",
            'end_date.date_format' => "掲載終了日時の形式を確認してください。",
            'end_date.after' => "掲載終了日時を掲載開始日時より後にしてください。",
            'end_date.before' => "プロジェクトの掲載期間は60日が上限です。",
            'images.required' => "画像は必須項目です。",
            'images.*.image' => "画像の形式が不正です。ご確認下さい。(jpg、jpeg、png、bmp、gif、svg、webp)",
            'video_url.regex' => "動画URLに問題がありました。ご確認ください。"
        ];
    }
}
