<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageContentRequest;
use App\Models\AdminMessageContent;
use App\Models\MessageContent;
use App\Models\Payment;
use App\Models\Project;
use App\Notifications\AppliedAdminMessageNotification;
use App\Notifications\AppliedMessageNotification;
use App\Traits\message\AdminMessageFunctions;
use App\Traits\message\MessageFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    use MessageFunctions, AdminMessageFunctions;

    public function index(Payment $selected_message = null)
    {
        $chating_messages = Payment::where('user_id', Auth::id())
            ->withCountNotRead("支援者")->NotGetUnderSuspensionProject()->groupBy('user_id')->orderBy('updated_at', 'desc')->get();
        $chating_myprojects = Project::where('user_id', Auth::id())
            ->notGetUnderSuspensionProject()->withNotReadByExecutor()->get();
        $admin_message = Auth::user()->load('adminMessageContents')->loadCount(['adminMessageContents' => function ($query) {
            $query->notRead("ユーザー");
        }]);

        return view('user.mypage.message.index', [
            'chating_messages' => $chating_messages,
            'chating_myprojects' => $chating_myprojects,
            'selected_message' => $selected_message ? $selected_message->load(['messageContents' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }]) : $selected_message,
            'admin_message' => $admin_message,
        ]);
    }

    public function store(MessageContentRequest $request, Payment $payment)
    {
        $this->authorize('checkOwnedBySupporter', $payment);
        if ($this->message_store($request, $payment, 'supporter')) {
            $payment->project->user->notify(new AppliedMessageNotification($payment));
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
        $chating_messages = Payment::where('project_id', $project->id)->messaging()->withCountNotRead("実行者")->groupBy('user_id')->orderBy('updated_at', 'desc')->get();
        $not_chating_messages = Payment::where('project_id', $project->id)->notMessaging()->withCountNotRead("実行者")->groupBy('user_id')->orderBy('updated_at', 'desc')->get();
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
            $payment->user->notify(new AppliedMessageNotification($payment));
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

    public function indexToAdmin()
    {
        Auth::guard('web')->user()->adminMessageContents()->read("ユーザー");
        $admin_message = Auth::user()->load('adminMessageContents')->loadCount(['adminMessageContents' => function ($query) {
            $query->notRead("ユーザー");
        }]);

        return view('user.mypage.message.index_to_admin', [
            'admin_message' => $admin_message,
        ]);
    }

    public function storeToAdmin(MessageContentRequest $request)
    {
        if ($this->admin_message_store($request, Auth::guard('web')->user(), 'user')) {
            Notification::route('mail', config('mail.customer_support.address'))
                ->notify(new AppliedAdminMessageNotification(Auth::guard('web')->user(), 'admin'));
            return redirect()->back()->with('flash_message', 'メッセージ送信が完了しました。');
        } else {
            return redirect()->back()->with('error', 'メッセージ送信に失敗しました。時間をおいてお試しください。');
        }
    }

    public function fileDownloadFromAdmin(AdminMessageContent $admin_message_content)
    {
        if ($admin_message_content->user->id = Auth::guard('web')->id()) {
            return Storage::download($admin_message_content->file_path, $admin_message_content->file_original_name);
        } else {
            return redirect()->back()->with('error', '不正なアクセスを確認しました。時間をおいてお試しください。');
        }
    }
}
