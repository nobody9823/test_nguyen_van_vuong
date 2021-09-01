<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendToSupporterRequest;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class SendToSupporterController extends Controller
{
    public function __invoke(Project $project, SendToSupporterRequest $request)
    {
        DB::beginTransaction();
        try {
            $project->payments()->whereIn('id', $request->payment_ids)->update(['is_sent' => true]);
            DB::commit();
            return redirect()->action([SupporterController::class, 'index'], ['project' => $project])->with(['flash_message' => '発送済みに変更しました。']);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return redirect()->action([SupporterController::class, 'index'], ['project' => $project])->withErrors(['エラーが発生しました。管理会社にご連絡をお願いします。']);
        }

    }
}
