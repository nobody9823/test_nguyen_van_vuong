<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailRequest;
use App\Mail\Company\MailToCheeringUsers;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function createCheeringUsersMail(Request $request, Project $project)
    {
        $users = User::find($request->user_ids);
        return view('company.mail.project.create_cheering_users_mail',
                      ['project' => $project->load(['plans', 'plans.users']), 'users' => $users]);
    }

    public function previewCheeringUsersMail(MailRequest $request)
    {
        $users = User::find($request->user_ids);

        $subject = $request->subject;
        $description = $request->description;

        return view('company.mail.project.preview_cheering_users_mail',
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

        return redirect()->route('company.project.index')->with('flash_message', 'メール送信が成功しました。');
    }
}
