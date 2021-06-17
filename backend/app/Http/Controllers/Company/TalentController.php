<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\TalentRequest;
use App\Models\Talent;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Storage;

class TalentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $talents = Talent::getTalentsByCompany();
        return view('company.talent.index', [
            'talents' => $talents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.talent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TalentRequest $request, Talent $talent)
    {
        $talent->company_id = Auth::id();
        $talent->fill($request->all())->save();
        return redirect()->action([TalentController::class, 'index'])->with('flash_message', "タレント作成が完了しました。");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Talent  $talent
     * @return \Illuminate\Http\Response
     */
    public function show(Talent $talent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Talent  $talent
     * @return \Illuminate\Http\Response
     */
    public function edit(Talent $talent)
    {
        return view('company.talent.edit', ['talent' => $talent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Talent  $talent
     * @return \Illuminate\Http\Response
     */
    public function update(TalentRequest $request, Talent $talent)
    {
        $talent->company_id = Auth::id();
        $talent->fill($request->all())->save();
        return redirect()->action([TalentController::class, 'index'])->with('flash_message', "更新が完了しました。");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Talent  $talent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talent $talent)
    {
        $talent->deleteImageIfSample();
        $talent->delete();
        return redirect()->action([TalentController::class, 'index'])->with('flash_message', "削除が完了しました。");
    }

    public function search(Request $request)
    {
        // 全角スペースを半角スペースに変換
        $words = str_replace("　", " ", $request->word);
        // 半角スペースごとに区切って配列に代入
        $array_words = explode(" ", $words);
        // 複数検索を実装するために、親のスコープからuseを使って$array_wordsを引き継ぎ、foreachで回して該当する企業名を取得する
        $talents = Talent::where(function ($talent) use ($array_words) {
            $talent->where('company_id', Auth::id());
            foreach ($array_words as $array_word) {
                $talent->where(function ($talent) use ($array_word) {
                    $talent->where('name', 'like', "%$array_word%");
                    $talent->orWhere('email', 'like', "%$array_word%");
                });
            }
        })->get();

        return view('company.talent.search', [
            'props' => $talents,
            'word' => $words,
        ]);
    }
}
