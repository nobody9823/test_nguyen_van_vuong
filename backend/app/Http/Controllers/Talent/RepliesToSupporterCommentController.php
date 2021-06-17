<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Http\Requests\RepliesToSupporterCommentRequest;
use App\Models\RepliesToSupporterComment;
use App\Models\SupporterComment;
use Illuminate\Http\Request;

class RepliesToSupporterCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SupporterComment $supporter_comment)
    {
        return view('talent.replies_to_supporter_comment.create', compact('supporter_comment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepliesToSupporterCommentRequest $request, SupporterComment $supporter_comment, RepliesToSupporterComment $replies_to_supporter_comment)
    {
        // FIXME Auth::id()ではなくてあえてsupporter_commentから取ってきているのは、後にフォームリクエストでまとめようと思っているためAdmin, Companyと合わせています。
        $replies_to_supporter_comment->talent_id = $supporter_comment->project->talent->id;
        $replies_to_supporter_comment->supporter_comment_id = $supporter_comment->id;
        $replies_to_supporter_comment->content = $request->content;
        $replies_to_supporter_comment->save();

        return redirect()->action([SupporterCommentController::class, 'index'])
                         ->with('flash_message', "支援者コメントへの返信が完了しました");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RepliesToSupporterComment  $repliesToSupporterComment
     * @return \Illuminate\Http\Response
     */
    // public function show(RepliesToSupporterComment $repliesToSupporterComment)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RepliesToSupporterComment  $repliesToSupporterComment
     * @return \Illuminate\Http\Response
     */
    public function edit(RepliesToSupporterComment $replies_to_supporter_comment)
    {
        return view('talent.replies_to_supporter_comment.edit', [
            'replies_to_supporter_comment' => $replies_to_supporter_comment->load(['supporterComment', 'supporterComment.project'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RepliesToSupporterComment  $repliesToSupporterComment
     * @return \Illuminate\Http\Response
     */
    public function update(RepliesToSupporterCommentRequest $request, RepliesToSupporterComment $repliesToSupporterComment)
    {
        $repliesToSupporterComment->content = $request->content;
        $repliesToSupporterComment->save();
        return redirect()->action([SupporterCommentController::class, 'index'])
                         ->with('flash_message', "支援者コメントへの返信の内容編集が完了しました");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RepliesToSupporterComment  $repliesToSupporterComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(RepliesToSupporterComment $repliesToSupporterComment)
    {
        $repliesToSupporterComment->delete();
        return redirect()->action([SupporterCommentController::class, 'index'])
                         ->with('flash_message', "支援者コメントへの返信の削除が完了しました");
    }
}
