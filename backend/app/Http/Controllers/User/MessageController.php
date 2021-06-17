<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageContentRequest;
use App\Models\MessageContent;
use App\Models\UserPlanCheering;
use App\Traits\message\MessageFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    use MessageFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chating_messages = UserPlanCheering::where('user_id', Auth::id())->messaging()->seeking()->orderBy('updated_at', 'desc')->get();
        $not_chating_messages = UserPlanCheering::where('user_id', Auth::id())->notMessaging()->seeking()->orderBy('updated_at', 'desc')->get();
        return view('user.mypage.message.index', [
            'chating_messages' => $chating_messages,
            'not_chating_messages' => $not_chating_messages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageContentRequest $request, UserPlanCheering $user_plan_cheering)
    {
        $this->authorize('checkOwnedByUser', $user_plan_cheering);
        if ($this->message_store($request, $user_plan_cheering, 'web')) {
            return redirect()->back()->with('flash_message', 'メッセージ送信が完了しました。');
        } else {
            return redirect()->back()->with('error', 'メッセージ送信に失敗しました。時間をおいてお試しください。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserPlanCheering $message)
    {
        $this->authorize('checkOwnedByUser', $message);
        $message->messageContents()->readByUser();
        $selected_message = $message;
        $chating_messages = UserPlanCheering::where('user_id', Auth::id())->messaging()->seeking()->orderBy('updated_at', 'desc')->get();
        $not_chating_messages = UserPlanCheering::where('user_id', Auth::id())->notMessaging()->seeking()->orderBy('updated_at', 'desc')->get();
        return view('user.mypage.message.index', [
            'chating_messages' => $chating_messages,
            'not_chating_messages' => $not_chating_messages,
            'selected_message' => $selected_message,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }

    public function file_download(MessageContent $message_content)
    {
        $this->authorize('checkOwnedByUser', $message_content);
        if ($message_content->userPlanCheering->user->id = Auth::guard()->id()) {
            return Storage::download($message_content->file_path, $message_content->file_original_name);
        } else {
            return redirect()->back()->with('error', '不正なアクセスを確認しました。時間をおいてお試しください。');
        }
    }
}
