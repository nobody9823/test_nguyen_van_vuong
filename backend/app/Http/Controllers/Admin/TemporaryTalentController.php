<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\TemporaryTalent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\AcceptTalent;
use Illuminate\Support\Facades\Mail;

class TemporaryTalentController extends Controller
{
    /**
     * Display a listing of temporary talents
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $temporary_talents = TemporaryTalent::getTemporaryTalents();
        return view('admin.temporary_talent.index', compact('temporary_talents'));
    }

    /**
     * Display detail information of selected temporary talent
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(TemporaryTalent $temporary_talent)
    {
        return view('admin.temporary_talent.show', compact('temporary_talent'));
    }

    /**
     * accept temporary talent and store it in talent table
     *
     * @param  TemporaryTalent  $temporary_talent
     * @return \Illuminate\Contracts\View\View
     */
    public function accept(TemporaryTalent $temporary_talent, Talent $talent)
    {
        DB::beginTransaction();
            try {
                $talent->fill($temporary_talent->toArray())->save();
                $temporary_talent->delete();
                DB::commit();
                Mail::to($talent->email)->send(new AcceptTalent());
                return redirect()->action([TemporaryTalentController::class, 'index'])->with('flash_message',
                    "選択したタレントの承認が完了しました。");
            } catch (\Exception $e) {
                return redirect()->action([TemporaryTalentController::class, 'index'])->with('flash_message',
                    "選択したタレントの承認に失敗しました。");
            }
    }

    /**
     * remove selected temporary talent from DB
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reject(TemporaryTalent $temporary_talent)
    {
        $temporary_talent->delete();
        return redirect()->action([TemporaryTalentController::class, 'index'])->with('flash_message',
            '指定した承認待ちタレントの申請を拒否しました。');
    }

    /**
     * search temporary talent and list result
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //全角スペースを半角スペースに変換
        $words = str_replace("　", " ", $request->word);
        //スペースで区切って検索語をそれぞれ配列に代入
        $search_words = explode(" ", $words);
        //DBからの検索処理
        $temporary_talents = TemporaryTalent::where(function ($query) use ($search_words) {
            foreach ($search_words as $search_word) {
                $query->orWhere('name', 'like', "%${search_word}%");
                $query->orWhere('email', 'like', "%${search_word}%");
            }
        })->get();

        return view('admin.temporary_talent.search',[
            'props' => $temporary_talents,
            'word' => $words,
        ]);
    }
}
