<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\SupporterComment;
use Illuminate\Http\Request;

class SupporterCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supporter_comments = SupporterComment::getSupporterCommentsByTalent()
            ->orderBy('created_at', 'DESC')
            ->with(['project', 'user', 'repliesToSupporterComment'])
            ->paginate(10);

        return view('talent.supporter_comment.index', [
            'supporter_comments' => $supporter_comments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupporterComment  $supporterComment
     * @return \Illuminate\Http\Response
     */
    // public function show(SupporterComment $supporterComment)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupporterComment  $supporterComment
     * @return \Illuminate\Http\Response
     */
    // public function edit(SupporterComment $supporterComment)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupporterComment  $supporterComment
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, SupporterComment $supporterComment)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupporterComment  $supporterComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupporterComment $supporter_comment)
    {
        $supporter_comment->delete();
        return redirect()->action([SupporterCommentController::class, 'index'])
                        ->with('flash_message', "支援者コメントの削除が完了しました");

    }

    public function search(SearchRequest $request)
    {
        $supporter_comments =
            SupporterComment::getSupporterCommentsByTalent()
                ->searchByWords($request->getArrayWords())
                ->searchByProject($request->project_id)
                ->searchWithPostDates($request->from_date, $request->to_date)
                ->with(['project', 'user', 'repliesToSupporterComment'])
                ->orderBy('created_at', 'DESC')
                ->paginate(10);

        return view('talent.supporter_comment.index', compact('supporter_comments'));
    }
}
