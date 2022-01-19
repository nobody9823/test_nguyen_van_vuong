<?php

namespace App\Traits\message;

use App\Enums\AdminMessageContributor;
use App\Enums\MessageContributor;
use App\Models\AdminMessageContent;
use Illuminate\Support\Facades\DB;

trait AdminMessageFunctions
{
    /**
     * Store a message created by Kosei.
     */
    public function admin_message_store(Object $request, Object $target, String $guard)
    {
        DB::beginTransaction();
        try {
            $message_content = new AdminMessageContent();
            if ($request->file_path) {
                $message_content->file_path = $request->file_path->store('public/file');
                $message_content->file_original_name = $request->file('file_path')->getClientOriginalName();
            }
            $message_content->content = $request->content;
            $message_content->message_contributor = $this->setAdminMessageContributor($guard);
            $target->adminMessageContents()->save($message_content);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return false;
        }
    }

    /**
     * Store a message created by Kosei.
     */

    public function setAdminMessageContributor(String $guard)
    {
        return AdminMessageContributor::getValue($guard);
    }
}
