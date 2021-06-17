<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Company;
use App\Http\Requests\RemarksRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Mail\Admin\MailForPasswordReset;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::getCompanies();
        return view('admin.company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request, RemarksRequest $remarksRequest, Company $company)
    {
        $company->fill(array_merge($request->all(), $remarksRequest->all()))->save();
        return redirect()->action([CompanyController::class, 'index'])->with('flash_message', '新規会社作成が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->fill($request->all())->save();

        return redirect()->action([CompanyController::class, 'index'])->with('flash_message', '会社情報編集が完了しました。');
    }

    /**
     * Update remarks of company
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function updateRemarks(RemarksRequest $request, Company $company)
    {
        return $company->fill($request->all())->save() ?
                redirect()->action([CompanyController::class, 'index'])->with('flash_message', '会社メモ編集が完了しました。') :
                redirect()->back()->withErrors('企業メモ編集に失敗しました。');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->deleteImageIfSample();
        $company->delete();
        return redirect()->action([CompanyController::class, 'index'])->with('flash_message', '削除が成功しました。');
    }

    public function search(SearchRequest $request)
    {
        $companies = Company::searchWords($request->getArrayWords())
                        ->orderBy('id', 'desc')->paginate(10);
        return view('admin.company.index', [
            'companies' => $companies,
            'word' => $request->getWords(),
        ]);
    }

    public function passwordReset(Company $company)
    {
        $token = Password::broker('company')
                        ->createToken($company);

        Mail::to($company)
        ->send(new MailForPasswordReset($token, $company));

        return redirect()->route('admin.company.index')->with('flash_message', 'メール送信が成功しました。');
    }

    public function release(Company $company, $is_released)
    {
        if ($is_released === "true") {
            if (!in_array('', $company->only(['id', 'title', 'email']), true)) {
                $company->is_released = true;
                $company->save();
                return response()->json('success');
            } elseif (in_array('', $company->only(['id', 'title', 'email']), true)) {
                return response()->json('hasEmpty');
            } else {
                return response()->json('fail');
            }
        } elseif($is_released === "false") {
            $company->is_released = false;
            $company->save();
            return response()->json('success');
        } else {
            return response()->json('fail');
        }
    }
}
