<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupporterCommentRequest;
use App\Models\Project;
use App\Models\SupporterComment;
use App\Models\UserSupporterCommentLiked;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SupporterCommentController extends Controller
{
    public function postComment(SupporterCommentRequest $request, Project $project,SupporterComment $supporterComment){
        $supporterComment->content = $request->content;
        $supporterComment->project_id = $project->id;
        $supporterComment->user_id = Auth::id();
        if ($request->image) {
            $supporterComment->image_url= $request->image->store('public/image');
        }
        $supporterComment->save();
        return redirect()->action([ProjectController::class, 'show'],['project' => $project])->with('flash_message', "投稿が完了しました。");
    }

    public function commentLiked(SupporterComment $supporterComment){
        $userLiked = UserSupporterCommentLiked::where('user_id', Auth::id())
                                                    ->where('supporter_comment_id', $supporterComment->id)
                                                    ->first();
        if(Auth::id() == $supporterComment->user_id){
            return response()->json('myself');
        } elseif ($userLiked !== null) {
            $userLiked->delete();
            return response()->json('canceled');
        } else {
            $commentLiked = new UserSupporterCommentLiked(['user_id' => Auth::id()]);
            $supporterComment->userSupporterCommentLiked()->save($commentLiked);
            return response()->json('success');
        }
    }
}
