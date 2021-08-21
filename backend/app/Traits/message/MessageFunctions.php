<?php

namespace App\Traits\message;

use App\Enums\MessageContributor;
use App\Mail\Admin\NotificationMessage;
use App\Models\MessageContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

trait MessageFunctions
{
    /**
     * Store a message created by Kosei.
     */
    public function message_store(Object $request, Object $target, String $guard)
    {
        DB::beginTransaction();
        try {
            $message_content = new MessageContent();
            if ($request->file_path) {
                $message_content->file_path = $request->file_path->store('public/file');
                $message_content->file_original_name = $request->file('file_path')->getClientOriginalName();
            }
            $message_content->content = $request->content;
            $message_content->message_contributor = $this->setMessageContributor($guard);
            $target->messageContents()->save($message_content);
            $target->update(['message_status' => $this->setMessageStatus($guard)]);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return false;
        }
    }

    /**
     * Send a email to User after sending a message created by Kosei.
     */
    public function sendEmailToUserForNotification(Object $recipient, Object $sender, String $url)
    {
        try {
            Mail::to($recipient)->send(new NotificationMessage($recipient, $sender, $url));
            return true;
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }

    /**
     * Store a message created by Kosei.
     */

    public function setMessageContributor(String $guard)
    {
        return MessageContributor::getValue($guard);
    }

    /**
     * Store a message created by Kosei.
     */

    public function setMessageStatus(String $guard)
    {
        if ($guard === 'supporter') {
            return '未対応';
        }
    }
}
