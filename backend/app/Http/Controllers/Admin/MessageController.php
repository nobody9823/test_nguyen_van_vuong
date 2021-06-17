<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MessageContributor;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageContentRequest;
use App\Mail\Admin\NotificationMessage;
use App\Models\MessageContent;
use App\Models\UserPlanCheering;
use App\Traits\message\MessageFunctions;
use Carbon\Carbon;
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
        $chating_messages = UserPlanCheering::with('messageContents')->messaging()->limit(100)->orderBy('updated_at', 'desc')->get();
        $not_chating_messages = UserPlanCheering::with('messageContents')->notMessaging()->limit(100)->orderBy('updated_at', 'desc')->get();
        return view('admin.message.index', [
            'chating_messages' => $chating_messages,
            'not_chating_messages' => $not_chating_messages
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
        $send_message_check = $this->message_store($request, $user_plan_cheering, 'admin');
        $send_email_check = $this->sendEmailToUserForNotification($user_plan_cheering->user, $user_plan_cheering->plan->project->talent, route('user.message.show', ['message' => $user_plan_cheering]));
        if ($send_message_check && $send_email_check) {
            return redirect()->back()->with('flash_message', 'メッセージ送信が完了しました。');
        } else {
            return redirect()->back()->with('error', 'メッセージ送信に失敗しました。時間をおいてお試しください。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessageContent  $messageContent
     * @return \Illuminate\Http\Response
     */
    public function show(UserPlanCheering $message)
    {
        $message->messageContents()->readByTalent();
        $selected_message = $message->load('messageContents');
        $chating_messages = UserPlanCheering::with('messageContents')->messaging()->limit(100)->orderBy('updated_at', 'desc')->get();
        $not_chating_messages = UserPlanCheering::with('messageContents')->notMessaging()->limit(100)->orderBy('updated_at', 'desc')->get();
        return view('admin.message.index', [
            'chating_messages' => $chating_messages,
            'not_chating_messages' => $not_chating_messages,
            'selected_message' => $selected_message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessageContent  $message_content
     * @return \Illuminate\Http\Response
     */
    // public function edit(MessageContent $messageContent)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessageContent  $message_content
     * @return \Illuminate\Http\Response
     */
    public function update(MessageContentRequest $request, MessageContent $message_content)
    {
        DB::beginTransaction();
        try {
            DB::table('message_contents')->where('id', $message_content->id)->update(['content' => $request->content]);
            DB::commit();
            return redirect()->back()->with('flash_message', '更新が完了しました。');
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return redirect()->back()->with('error', 'メッセージ更新に失敗しました。時間をおいてお試しください。');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessageContent  $message_content
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageContent $message_content)
    {
        DB::beginTransaction();
        try {
            DB::table('message_contents')->where('id', $message_content->id)->update(['deleted_at' => new Carbon()]);
            DB::commit();
            return redirect()->back()->with('flash_message', '削除が完了しました。');
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return redirect()->back()->with('error', 'メッセージ削除に失敗しました。時間をおいてお試しください。');
        }
    }

    public function file_download(MessageContent $message_content)
    {
        return Storage::download($message_content->file_path, $message_content->file_original_name);
    }
}
