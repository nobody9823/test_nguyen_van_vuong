<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Project;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Project $project){
        $comments = $project->comments()->with('project.user.profile','payment.user.profile')
                            ->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('user.comment.index',[
            'comments' => $comments
        ]);
    }

    public function postComment(CommentRequest $request, Project $project,Comment $comment){
        $comment->content = $request->content;
        $comment->project_id = $project->id;
        return $request->user()->comments()->save($comment)
            ? redirect()->action([ProjectController::class, 'show'],['project' => $project])->with('flash_message', "投稿が完了しました。")
            : redirect()->back()->withErrors("投稿に失敗しました。管理者にお問い合わせください。");
    }
}
