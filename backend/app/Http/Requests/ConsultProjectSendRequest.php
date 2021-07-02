<?php

namespace App\Http\Requests;

use App\Helpers\PrefectureHelper;
use App\Models\Tag;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConsultProjectSendRequest extends FormRequest
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
        // FIXME 今後この項目が管理画面で管理される場合はそのテーブルの値を、固定の場合はprefectureのようにクラスにしてそこから取ってくる
        $motive_rulein = [
            'Facebook広告/Twitter広告',
            'SNSでの友人のシェア/リツイート',
            'Webメディアの記事',
            'テレビ・ラジオ番組',
            'テレビCM',
            '書籍/雑誌/新聞',
            '友達・知人',
            '金融機関からの紹介',
            'FanReturnを実施した実行者の紹介',
            'FanReturnが主催したイベント',
            'FanReturnスタッフからのご連絡',
            '過去に問い合わせをしたことがある',
            '過去にFanReturnを実施したことがある',
        ];
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::user())],
            'phone_number' => ['required', 'regex:/^[0-9]+$/i'],
            'postal_code' => ['required', 'regex:/^[0-9]+$/i'],
            'prefecture' => ['required', Rule::in(PrefectureHelper::getPrefectures())],
            'city' => ['required', 'string', 'max:255'],
            'block' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'site_url' => ['nullable', 'url'],
            'tag' => ['required', Rule::in(Tag::pluck('name'))],
            'commission' => ['required', Rule::in(['シンプルサポート', 'スタンダートサポート', 'プレミアムサポート', 'フルサポートプラン'])],
            'motive' => ['required', Rule::in($motive_rulein)],
            'introducer' => ['nullable', 'string', 'max:255'],
            'consultation_content' => ['required', 'string', 'max:500'],
            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'image'],
        ];
    }

    public function passedValidation()
    {
        if (is_null($this->building)) {
            $this->merge(['building' => '']);
        }
    }

    public function attributes()
    {
        return [
            'site_url' => '企業ホームページ',
            'motive' => 'fanReturnにご相談いただいたきっかけ',
            'introducer' => '紹介企業名や、紹介者名、FanReturnの担当者名',
            'consultation_content' => '相談内容',
            'commission' => 'プラン',
            'tag' => 'カテゴリ',
            'files' => '画像ファイル',
            'files.*' => '画像ファイル',
        ];
    }

    public function messages()
    {
        return [
            'phone_number.regex' => ':attributeは０〜９の数字で入力してください',
            'postal_code.regex' => ':attributeは０〜９の数字で入力してください',
        ];
    }
}
