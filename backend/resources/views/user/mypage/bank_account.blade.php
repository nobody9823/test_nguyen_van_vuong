@extends('user.layouts.base')

@section('title', 'マイページ | 銀行口座登録')

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>BANK ACCOUNT</h2>
        <div class="sub_tit_L">銀行口座登録</div>
    </div>
    <div class="prof_page_base inner_item">
        <x-user.mypage-navigation-bar/>
        <div class="prof_page_R">
            <div class="def_outer_gray">
                <section id="identification_section" class="my_project_section def_inner inner_item">
                    <form action="{{ route('user.bank_account.update') }}" method="POST">
                        @csrf
                        <div class="ps_description">
                            <h4 style="color: #e65d65">以下の注意事項をご確認ください。</h4>
                            <ul>
                                <li>こちらの銀行口座情報はプロジェクト達成後の振込先としてご登録ください。</li>
                                <li>ご登録いただいた口座情報はGMOPG送金サービスによって安全に管理されます。</li>
                                <li>ゆうちょ銀行の「貯蓄口座」に対してはGMOPG送金サービスでは送金できません。</li>
                            </ul>
                        </div>
                        <div class="form_item_row">
                            <div class="form_item_tit">
                                金融機関コード・銀行コード
                                <br/>
                                <span>
                                    <a href="https://www.zenginkyo.or.jp/abstract/outline/organization/member-01/" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        金融機関コードが不明な方はこちら
                                    </a>
                                </span>
                            </div>
                            <input id="bankCode" type="number" name="bank_code" class="def_input_100p"
                                value="{{ old('bank_code') }}">
                        </div>

                        <div class="form_item_row">
                            <div class="form_item_tit">支店番号</div>
                            <input id="branchCode" type="number" name="branch_code" class="def_input_100p"
                                value="{{ old('branch_code') }}">
                        </div>

                        <div class="form_item_row">
                            <div class="form_item_tit">口座種別</div>
                            <div class="cp_ipselect cp_normal">
                                <select name="account_type">
                                    @foreach(\App\Enums\BankAccountType::getValues() as $account_type)
                                        <option value="{{ $account_type }}" {{ $account_type === old('account_type') ? 'selected' : '' }}>{{ $account_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form_item_row">
                            <div class="form_item_tit">口座番号</div>
                            <input id="accountNumber" type="number" name="account_number" class="def_input_100p"
                                value="{{ old('account_number') }}">
                        </div>

                        <div class="form_item_row">
                            <div class="form_item_tit">口座名義</div>
                            <input id="holderName" type="text" name="account_name" class="def_input_100p"
                                value="{{ old('account_name') }}">
                        </div>
                        <div class="def_btn">
                            <button type="submit" class="disable-btn">
                                <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存する</p>
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</section>
@endsection
