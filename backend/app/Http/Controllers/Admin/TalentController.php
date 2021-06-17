<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\Company;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TalentRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use App\Mail\Admin\MailForPasswordReset;
use Illuminate\Support\Facades\Mail;

class TalentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $talents = Talent::getTalents();
        return view('admin.talent.index', ['talents' => $talents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::getAllCompanies()->pluck('name', 'id');
        return view('admin.talent.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TalentRequest $request, Talent $talent)
    {
        $talent->fill($request->all())->save();
        return redirect()->action([TalentController::class, 'index'])->with('flash_message', "タレント作成が完了しました。");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Talent $talent)
    {
        $companies = Company::getAllCompanies()->pluck('name', 'id');
        return view('admin.talent.edit', ['talent' => $talent, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TalentRequest $request, Talent $talent)
    {
        $talent->fill($request->all())->save();
        return redirect()->action([TalentController::class, 'index'])->with('flash_message', "更新が完了しました。");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talent $talent)
    {
        $talent->deleteImageIfSample();
        $talent->delete();
        return redirect()->action([TalentController::class, 'index'])->with('flash_message', "削除が完了しました。");
    }

    /**
     * search talent and list result
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
        //DBからの検索処理
        $talents = Talent::searchWords($request->getArrayWords())->paginate(10);

        return view('admin.talent.index', [
            'talents' => $talents,
            'word' => $request->getWords(),
        ]);
    }

    /**
     * send password reset mail to talent
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordReset(Talent $talent)
    {
        $token = Password::broker('talent')->createToken($talent);
        Mail::to($talent)
            ->send(new MailForPasswordReset($token, $talent));

        return redirect()->route('admin.talent.index')->with('flash_message', "メール送信が完了しました。");
    }

    public function release(Talent $talent, $is_released)
    {
        if ($is_released === "true") {
            if (!in_array('', $talent->only(['id', 'title']), true)) {
                $talent->is_released = true;
                return $talent->save() ? response()->json('success') : response()->json('fall');
            } elseif (in_array('', $talent->only(['id', 'title']), true)) {
                return response()->json('hasEmpty');
            }
        } elseif ($is_released === "false") {
            $talent->is_released = false;
            return $talent->save() ? response()->json('success') : response()->json('fall');
        }
    }
}
