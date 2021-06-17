<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\MailToCheeringUsers;

class MailController extends Controller
{
    public function createCheeringUsersMail(Request $request, Project $project)
    {
        $users = User::find($request->user_ids);
        return view('admin.mail.project.create_cheering_users_mail',
                      ['project' => $project->load(['plans', 'plans.users']), 'users' => $users]);
    }

    public function previewCheeringUsersMail(MailRequest $request)
    {
        $users = User::find($request->user_ids);

        $subject = $request->subject;
        $description = $request->description;

        return view('admin.mail.project.preview_cheering_users_mail',
                      ['subject' => $subject, 'description' => $description, 'users' => $users]);
    }

    public function sendCheeringUsersMail(MailRequest $request)
    {
        $users = User::find($request->user_ids);

        $subject = $request->subject;
        $description = $request->description;

        foreach ($users as $user) {
            Mail::to($user)
                ->send(new MailToCheeringUsers($subject, $description, $user));
        }

        return redirect()->route('admin.project.index')->with('flash_message', 'メール送信が成功しました。');
    }
}
