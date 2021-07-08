<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = Comment::search()->narrowDownWithProject()
                                     ->searchWithPostDates($request->from_date, $request->to_date)
                                     ->with(['project', 'payment.user','reply'])
                                     ->sortBySelected($request->sort_type);

        //リレーション先OrderBy
        if ($request->sort_type === 'payment_user_name_asc') {
            $comments = $comments->get()->sortBy('payment.user.name')->paginate(10);
        } elseif ($request->sort_type === 'payment_user_name_desc') {
            $comments = $comments->get()->sortByDesc('payment.user.name')->paginate(10);
        } elseif ($request->sort_type === 'project_id_asc') {
            $comments = $comments->get()->sortBy('project.id')->paginate(10);
        } elseif ($request->sort_type === 'project_id_desc') {
            $comments = $comments->get()->sortByDesc('project.id')->paginate(10);
        } elseif ($request->sort_type === 'project_user_name_asc') {
            $comments = $comments->get()->sortBy('project.user.name')->paginate(10);
        } elseif ($request->sort_type === 'project_user_name_desc') {
            $comments = $comments->get()->sortByDesc('project.user.name')->paginate(10);
        } elseif ($request->sort_type === 'reply_content_asc') {
            $comments = $comments->get()->sortBy('reply.content')->paginate(10);
        } elseif ($request->sort_type === 'reply_content_desc') {
            $comments = $comments->get()->sortByDesc('reply.content')->paginate(10);
        } elseif ($request->sort_type === 'reply_exist_asc') {
            $comments = $comments->get()->sortBy(function ($comment, $key) {
                return isset($comment->reply);
            })->paginate(10);
        } elseif ($request->sort_type === 'reply_exist_desc') {
            $comments = $comments->get()->sortByDesc(function ($comment, $key) {
                return isset($comment->reply);
            })->paginate(10);
        } else {
            $comments = $comments->paginate(10);
        }
        return view('admin.comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // TODO:今後、管理画面で支援者コメントを削除する仕様になれば使用する。そうでない場合は削除してください。
    // public function destroy(Comment $comment)
    // {
    //     $comment->delete();
    //     return redirect()->action([CommentController::class, 'index'])
    //                      ->with('flash_message', "支援者コメントの削除が完了しました");
    // }
}
