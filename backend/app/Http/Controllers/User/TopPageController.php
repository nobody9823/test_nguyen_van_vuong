<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopPageController extends Controller
{
    // FAQ
    public function question()
    {
        return view('user.question');
    }

    // 特定商取引法に基づく表示
    public function tradelaw()
    {
        return view('user.tradelaw');
    }

    // 利用規約
    public function terms()
    {
        return view('user.terms');
    }

    public function privacyPolicy()
    {
        return view('user.privacy_policy');
    }
}
