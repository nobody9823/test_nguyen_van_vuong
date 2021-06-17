<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\User\MailFromInquiry;
use App\Models\Admin;
use App\Http\Requests\InquiryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
// use URL;

class InquiryController extends Controller
{
    public function createInquiry()
    {
        // お問い合わせ種別のセレクトボックスに送る項目
        $inquiry_categories = array(
            "プロジェクト掲載の相談",
            "プロジェクトの中断依頼(プロジェクト掲載者様専用)",
            "プロジェクトの修正依頼(プロジェクト掲載者様専用)",
            "不適切な表現のプロジェクト、プラン、活動報告、支援者一覧コメントの連絡",
            "本サイトに関する不具合の確認",
            "弊社に対する意見",
            "ご質問",
            "その他"
        );

        return view('user.mail.inquiry.create_inquiry',[
        'inquiry_categories' => $inquiry_categories,
        ]);
    }

    public function sendInquiry(InquiryRequest $inquiry)
    {
        // 画像をStoragesに保存し、そのファイル名を$file_namesの配列に挿入。
        $file_names = array();
        if ($inquiry->images) {
            foreach ($inquiry->images as $image) {
                $file_name = $image->getClientOriginalName();
                $image->storeAS('public/image', $file_name);
                $inputs['path'] = $file_name;
                array_push($file_names, $file_name);
            }
        } else {
            $file_names = null;
        }

        Mail::to(Admin::get("email"))->send(new MailFromInquiry($inquiry, $file_names));

        // メールを送信した後、アップロードしたStorage内の画像を削除する。
        if (isset($file_names)) {
            foreach ($file_names as $file_name) {
                Storage::delete('public/image/' . $file_name);
            }
        }
    
        return redirect()->route('user.inquiry.create')->with('flash_message', 'メール送信が成功しました。');
    }
}
