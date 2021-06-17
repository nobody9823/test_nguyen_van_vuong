<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\TemporaryCompany;
use Illuminate\Http\Request;
use App\Mail\AcceptCompany;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class TemporaryCompanyController extends Controller
{
    /**
     * Display a listing of temporary companies
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $temporary_companies = TemporaryCompany::getTemporaryCompanies();
        return view('admin.temporary_company.index', compact('temporary_companies'));
    }

    /**
     * Display detail information of selected temporary company
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(TemporaryCompany $temporary_company)
    {
        return view('admin.temporary_company.show', compact('temporary_company'));
    }

    /**
     * accept temporary company and store it in company table
     *
     * @param  TemporaryCompany  $temporary_company
     * @return \Illuminate\Contracts\View\View
     */
    public function accept(TemporaryCompany $temporary_company, Company $company)
    {
        DB::beginTransaction();
            try {
                $company->fill($temporary_company->toArray())->save();
                $temporary_company->delete();
                DB::commit();
                Mail::to($company->email)->send(new AcceptCompany());
                return redirect()->action([TemporaryCompanyController::class, 'index'])->with('flash_message',
                    "選択した企業の承認が完了しました。");
            } catch(\Exception $e) {
                DB::rollback();
                return redirect()->action([TemporaryCompanyController::class, 'index'])->with('flash_message',
                    "選択した企業の承認に失敗しました。");
            }
    }

    /**
     * remove selected temporary company from DB
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reject(TemporaryCompany $temporary_company)
    {
        $temporary_company->delete();
        return redirect()->action([TemporaryCompanyController::class, 'index'])->with('flash_message',
            '指定した承認待ち企業の申請を拒否しました。');
    }

    /**
     * search temporary company and list result
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
        $temporary_companies = TemporaryCompany::where(function ($query) use ($search_words) {
            foreach ($search_words as $search_word) {
                $query->orWhere('name', 'like', "%${search_word}%");
                $query->orWhere('email', 'like', "%${search_word}%");
            }
        })->getTemporaryCompanies();

        return view('admin.temporary_company.index',[
            'temporary_companies' => $temporary_companies,
            'word' => $words,
        ]);
    }
}
