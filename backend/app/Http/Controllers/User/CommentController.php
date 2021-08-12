<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Project;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('checkOwnProject', $project);
        $comments = $project->comments()->with('reply', 'user.profile')
                            ->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('user.comment.index', [
            'comments' => $comments
        ]);
    }

    public function postComment(CommentRequest $request, Project $project, Comment $comment)
    {
        $comment->content = $request->content;
        $comment->project_id = $project->id;
        return $request->user()->comments()->save($comment)
            ? redirect()->action([ProjectController::class, 'show'], ['project' => $project])->with('flash_message', "投稿が完了しました。")
            : redirect()->back()->withErrors("投稿に失敗しました。管理者にお問い合わせください。");
    }

    public function destroy(Request $request, Project $project, Comment $comment)
    {
        $this->authorize('checkOwnProject', $project);
        DB::beginTransaction();
        try {
            $comment->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::alert($e);
            return redirect()->back()->withErrors('返信内容の送信に失敗しました。管理会社にご連絡をお願いします。');
        }
        return redirect()->action([self::class, 'index'], ['project' => $project])->with('flash_message', 'コメントを削除しました。');
    }
}
