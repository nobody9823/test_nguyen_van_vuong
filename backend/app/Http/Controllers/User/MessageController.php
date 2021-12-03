<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageContentRequest;
use App\Models\MessageContent;
use App\Models\Payment;
use App\Models\Project;
use App\Traits\message\MessageFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    use MessageFunctions;

    public function index(Payment $selected_message = null)
    {
        $chating_messages = Payment::where('user_id', Auth::id())->withCountNotRead("支援者")->orderBy('updated_at', 'desc')->get();
        $chating_myprojects = Project::where('user_id', Auth::id())->withNotReadByExecutor()->get();
        return view('user.mypage.message.index', [
            'chating_messages' => $chating_messages,
            'chating_myprojects' => $chating_myprojects,
            'selected_message' => $selected_message ? $selected_message->load(['messageContents' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }]) : $selected_message,
        ]);
    }

    public function store(MessageContentRequest $request, Payment $payment)
    {
        $this->authorize('checkOwnedBySupporter', $payment);
        if ($this->message_store($request, $payment, 'supporter')) {
            return redirect()->back()->with('flash_message', 'メッセージ送信が完了しました。');
        } else {
            return redirect()->back()->with('error', 'メッセージ送信に失敗しました。時間をおいてお試しください。');
        }
    }

    public function show(Payment $payment)
    {
        $this->authorize('checkOwnedBySupporter', $payment);
        $payment->messageContents()->read("支援者");
        $payment->refresh();
        return redirect()->action([MessageController::class, 'index'], ['selected_message' => $payment]);
    }

    public function fileDownload(MessageContent $message_content)
    {
        $this->authorize('checkOwnedBySupporter', $message_content);
        if ($message_content->payment->user->id = Auth::guard()->id()) {
            return Storage::download($message_content->file_path, $message_content->file_original_name);
        } else {
            return redirect()->back()->with('error', '不正なアクセスを確認しました。時間をおいてお試しください。');
        }
    }

    public function indexByExecutor(Project $project, Payment $selected_message = null)
    {
        $this->authorize('checkOwnProject', $project);
        $chating_messages = Payment::where('project_id', $project->id)->messaging()->withCountNotRead("実行者")->orderBy('updated_at', 'desc')->get();
        $not_chating_messages = Payment::where('project_id', $project->id)->notMessaging()->withCountNotRead("実行者")->orderBy('updated_at', 'desc')->get();
        return view('user.my_project.message.index', [
            'project' => $project,
            'chating_messages' => $chating_messages,
            'not_chating_messages' => $not_chating_messages,
            'selected_message' => $selected_message ? $selected_message->load(['messageContents' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }]) : $selected_message,
        ]);
    }

    public function storeByExecutor(MessageContentRequest $request, Payment $payment)
    {
        $this->authorize('checkOwnedByExecutor', $payment);
        if ($this->message_store($request, $payment, 'executor')) {
            return redirect()->back()->with('flash_message', 'メッセージ送信が完了しました。');
        } else {
            return redirect()->back()->with('error', 'メッセージ送信に失敗しました。時間をおいてお試しください。');
        }
    }

    public function showByExecutor(Payment $payment)
    {
        $this->authorize('checkOwnedByExecutor', $payment);
        $payment->messageContents()->read("実行者");
        $payment->refresh();
        return redirect()->action([MessageController::class, 'indexByExecutor'], ['project' => $payment->project, 'selected_message' => $payment]);
    }

    public function fileDownloadByExecutor(MessageContent $message_content)
    {
        $this->authorize('checkOwnedByExecutor', $message_content);
        if ($message_content->payment->project->user->id = Auth::guard()->id()) {
            return Storage::download($message_content->file_path, $message_content->file_original_name);
        } else {
            return redirect()->back()->with('error', '不正なアクセスを確認しました。時間をおいてお試しください。');
        }
    }
}
