<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class ReplyController extends Controller
{
    public function store(Request $request, Project $project, Comment $comment)
    {
        $this->authorize('checkOwnProject', $project);
        DB::beginTransaction();
        try {
            $comment->reply()->save(new Reply([
                'content' => $request->content
            ]));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::alert($e);
            return redirect()->back()->withErrors('返信内容の送信に失敗しました。管理会社にご連絡をお願いします。');
        }
        return redirect()->action([CommentController::class, 'index'], ['project' => $project])->with('flash_message', '返信内容を送信しました。');
    }
    
    public function destroy(Request $request, Project $project, Reply $reply)
    {
        $this->authorize('checkOwnProject', $project);
        DB::beginTransaction();
        try {
            $reply->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::alert($e);
            return redirect()->back()->withErrors('返信内容の送信に失敗しました。管理会社にご連絡をお願いします。');
        }
        return redirect()->action([CommentController::class, 'index'], ['project' => $project])->with('flash_message', '返信を削除しました。');
    }
}
