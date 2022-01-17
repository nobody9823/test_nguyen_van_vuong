<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageContentRequest;
use App\Mail\Admin\NotificationMessage;
use App\Models\AdminMessageContent;
use App\Models\MessageContent;
use App\Models\User;
use App\Traits\message\AdminMessageFunctions;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    use AdminMessageFunctions;

    public function index(User $selected_message = null)
    {
        $messages = User::orderBy('updated_at', 'desc')
            ->with('adminMessageContents')
            ->withCountNotReadAdminMessageContents("管理者")
            ->get();
        return view('admin.message.index', [
            'messages' => $messages,
            'selected_message' => $selected_message ? $selected_message->load(['adminMessageContents' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }]) : $selected_message,
        ]);
    }

    public function store(MessageContentRequest $request, User $user)
    {
        if ($this->message_store($request, $user, 'admin')) {
            // $payment->project->user->notify(new AppliedMessageNotification($payment));
            return redirect()->back()->with('flash_message', 'メッセージ送信が完了しました。');
        } else {
            return redirect()->back()->with('error', 'メッセージ送信に失敗しました。時間をおいてお試しください。');
        }
    }

    public function show(User $user)
    {
        $user->adminMessageContents()->read("管理者");
        $user->refresh();
        return redirect()->action([MessageController::class, 'index'], ['selected_message' => $user]);
    }

    public function fileDownload(AdminMessageContent $admin_message_content)
    {
        return Storage::download($admin_message_content->file_path, $admin_message_content->file_original_name);
    }
}
