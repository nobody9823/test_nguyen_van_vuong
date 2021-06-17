<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\TemporaryTalent;
use Illuminate\Http\Request;

class TemporaryTalentController extends Controller
{
    /**
     * Display a listing of temporary talents
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $temporary_talents = TemporaryTalent::getTemporaryTalentsForCompany(\Auth::id());
        return view('company.temporary_talent.index', compact('temporary_talents'));
    }

    /**
     * Display detail information of selected temporary talent
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(TemporaryTalent $temporary_talent)
    {
        return view('company.temporary_talent.show', compact('temporary_talent'));
    }

    public function accept(TemporaryTalent $temporary_talent, Talent $talent)
    {
        $talent->company_id = $temporary_talent->company_id;
        $talent->name = $temporary_talent->name;
        $talent->email = $temporary_talent->email;
        $talent->password = $temporary_talent->password;
        $talent->image_url = $temporary_talent->image_url;
        //タレントの保存が成功したら、一時タレントを削除して再び一覧へ。失敗したら失敗メッセージと共に再び一覧へ。
        if ($talent->save()) {
            $temporary_talent->delete();
        } else {
            return redirect()->action([TemporaryTalentController::class, 'index'])->with('flash_message',
                "選択したタレントの承認に失敗しました。");
        }
        return redirect()->action([TemporaryTalentController::class, 'index'])->with('flash_message',
            "選択したタレントの承認が完了しました。");
    }

    public function reject(TemporaryTalent $temporary_talent)
    {
        $temporary_talent->delete();
        return redirect()->action([TemporaryTalentController::class, 'index'])->with('flash_message',
            '指定した承認待ちタレントの申請を拒否しました。');
    }

    public function search(Request $request)
    {
        //全角スペースを半角スペースに変換
        $word = str_replace("　", " ", $request->word);
        //スペースで区切って検索語をそれぞれ配列に代入
        $search_words = explode(" ", $word);
        //DBからの検索処理
        $temporary_talents = TemporaryTalent::where('company_id', \Auth::id())
            ->Where(
                (function ($query) use ($search_words) {
                    foreach ($search_words as $search_word) {
                        $query->orWhere('name', 'like', "%${search_word}%");
                        $query->orWhere('email', 'like', "%${search_word}%");
                    }
                }))->get();

        return view('company.temporary_talent.search', [
            'props' => $temporary_talents,
            'word' => $word,
        ]);
    }

}
