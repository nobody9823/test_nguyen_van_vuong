<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\ProjectFile;
use App\Models\ProjectVideo;
use App\Models\ProjectTagTagging;
use App\Rules\ProjectImages;
use App\Rules\Tags;
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
            'user_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'], // 最大16,777,215文字（約16Mバイト）
            // WARNING:支援総額順のPSリターンを使用する際はprepareForValidationの空文字登録処理を削除して下さい。
            // 'reward_by_total_amount' => ['required', 'string'], // 最大16,777,215文字（約16Mバイト）
            'reward_by_total_quantity' => ['required', 'string'], // 最大16,777,215文字（約16Mバイト）
            // 'target_amount' => ['required', 'integer', 'min:10000', 'max:99999999'],
            'target_number' => ['required', 'integer', 'min:1', 'max:9999999'],
            'curator_id' => ['nullable', 'exists:curators,id'],
            // タレント画面でプロジェクト作成をする時のみ、タレントidのバリデーションは実行しない。
            'start_date' => ['required', 'date_format:Y-m-d H:i:s', $this->isMethod('post') ? 'after:1 week' : ''],
            'end_date' => ['required', 'date_format:Y-m-d H:i:s', 'after:start_date', "before:{$end_date_limit}"],
            'tags' => ['required', new Tags($request)],
            'images' => [Rule::requiredIf($request->isMethod('post')), new ProjectImages($request)],
            'images.*' => ['image'], //images配列の中身を見る
            'video_url' => ['nullable', 'url', 'regex:#(https?://www.youtube.com/.*)(v=([-\w]{11}))#'],
        ];
    }

    // requestのImagesから、ProjectImageインスタンスの配列変数として返す
    public function imagesToArray(): array
    {
        $projectFiles = array();
        $data = $this->all();

        if ($this->file('images') !== null) {
            foreach ($data['images'] as $image) {
                $projectFiles[] = new ProjectFile([
                    'file_url' => $image,
                    'file_content_type' => 'image_url'
                ]);
            }
        }
        return $projectFiles;
    }

    public function projectVideo()
    {
        if (isset($this->all()['video_url']) && $this->all()['video_url'] !== null) {
            return new ProjectFile([
                'file_url' => $this->all()['video_url'],
                'file_content_type' => 'video_url'
            ]);
        }
        return null;
    }

    protected function prepareForValidation()
    {
        // youtubeが短縮urlだった場合、通常のurlに変換する。その後通常通りバリデーションにかける
        if ($this->input('video_url')) {
            $short_url = $this->input('video_url');
            $headers = get_headers($short_url, 1);
            $original_url = isset($headers['Location']) ? $headers['Location'] : $short_url;

            $this->merge(['video_url' => $original_url]);
        }

        // 現状支援総額順のPSリターンは使用しない為、reward_by_total_amountは空文字で登録する。
        if ($this->reward_by_total_amount === null) {
                $this->merge([
                    'reward_by_total_amount' => ''
                ]);
            };
    }

    public function messages()
    {
        return [
            'tags.required' => "タグを選択してください。",
            'title.required' => "タイトルを入力してください。",
            'title.string' => "タイトルは文字で入力してください。",
            'title.max' => "タイトルは255文字以内にしてください。",
            'content.required' => "プロジェクト内容を入力してください。",
            'content.string' => "プロジェクト内容は文字で入力してください。",
            'content.max' => "プロジェクト内容は100000文字以内にしてください。",
            // 'target_amount.required' => "目標金額を入力してください。",
            // 'target_amount.integer' => "目標金額は数字で入力してください。",
            // 'target_amount.min' => "目標金額は10,000円以上にしてください。",
            // 'target_amount.max' => "目標金額は99,999,999円以内にしてください。",
            'target_number.required' => "目標人数を入力してください。",
            'target_number.integer' => "目標人数は数字で入力してください。",
            'target_number.min' => "目標人数は1人以上にしてください。",
            'target_number.max' => "目標人数は9,999,999人以内にしてください。",
            'curator_id.required' => "キュレーターを入力してください。",
            'curator_id.exists' => '選択されたキュレーターは存在しておりません。',
            'start_date.required' => "掲載開始日時を入力してください。",
            'start_date.date_format' => "掲載開始日時の形式を確認してください。",
            'start_date.after' => "掲載開始日時を1週間後以降に設定してください",
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
