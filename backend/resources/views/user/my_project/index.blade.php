@extends('user.layouts.base')

@section('title', 'マイページ | マイプロジェクト')

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>MY PROJECTS</h2>
        <div class="sub_tit_L">マイプロジェクト</div>
    </div>
    <div class="prof_page_base inner_item">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div>
        <div class="prof_page_R">
            <section id="pc-top_04" class="section_base">
                <div class="my_project_container">
                    @foreach($projects as $project)
                    <div class="my_project_img_box_wrapper">
                        @if ($project->release_status === ProjectReleaseStatus::getValue('Default') || $project->release_status === ProjectReleaseStatus::getValue('SendBack'))
                        <div>
                            <form action="{{ route('user.my_project.project.destroy', ['project' => $project]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')" class="my_project_delete_form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fas fa-times-circle fa-2x my_project_delete_btn"></button>
                            </form>
                        </div>
                        @endif
                        <div class="ib02_01 E-font my_project_img_wrapper">
                            <a href="{{ route('user.my_project.project.show', ['project' => $project]) }}">
                                @if ($project->projectFiles()->where('file_content_type', 'image_url')->count() > 0)
                                    <img src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
                                @else
                                    <img src={{ Storage::url('public/sampleImage/now_printing.png') }}>
                                @endif
                            </a>
                            {{-- NOTICE: MyProjectController, show action --}}
                        </div>

                        <div class="ib02_03">
                            <a href="{{ route('user.my_project.project.show', ['project' => $project]) }}">
                                <h3>{{ Str::limit($project->title, 40) }}</h3>
                                {{-- NOTICE: MyProjectController, show action--}}
                            </a>
                        </div>

                        <div class="def_btn edit_btn">
                            @if($project->release_status === '---' || $project->release_status === '差し戻し' || $project->release_status === '掲載停止中')
                            編集
                            {{-- NOTICE: MyProjectController, edit action --}}
                            <a class="display_release_status" href="{{ route('user.my_project.project.edit', ['project' => $project]) }}"></a>
                            @elseif($project->release_status === '承認待ち' || $project->release_status === '掲載中')
                            {{ $project->release_status }}
                            <a class="display_release_status"></a>
                            @endif
                        </div>

                        <div class="my_project_img_content_wrapper">
                            <div class="my_project_release_status">
                                <div class="my_project_apply_wrapper">
                                    @if($project->release_status === ProjectReleaseStatus::getValue('Default') || $project->release_status === ProjectReleaseStatus::getValue('SendBack') || $project->release_status === ProjectReleaseStatus::getValue('UnderSuspension'))
                                    <div class="apply_btn">
                                        <form action="{{ route('user.project.apply', ['project' => $project]) }}" method="POST" id="apply_form">
                                            @csrf
                                            申請
                                            <button
                                                type="button"
                                                class="cover_link disable-btn"
                                                onclick="applySubmit(
                                                    {{ $project }},
                                                    {{ $project->plans }},
                                                    {{ $project->tags }},
                                                    {{ $project->user->profile }},
                                                    {{ $project->user->address }},
                                                    {{$project->user->identification}},
                                                    {{ $bank_account }}
                                                )"
                                            >
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @if($project->release_status === '差し戻し' || $project->release_status === '掲載停止中')
                            <div class="caution_release_status">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $project->release_status }}
                            </div>
                            @endif
                        </div>
                    </div><!--/.img_box_01_L_item-->
                    @endforeach
                </div>
            </section><!--/#pc-top_04-->
            <div class="my_new_project_wrapper">
                {{--NOTICE: MyProjectController, create action --}}
                <a href="{{ route('user.my_project.project.create') }}" class="footer-over_L my_new_project">
                    <div class="footer-over_L_02">
                    <div class="footer-over_L_02_01">New Project</div>
                    <div class="footer-over_L_02_02">新規プロジェクト作成はこちら</div>
                    </div>
                    <div class="footer-over_L_03"><i class="fas fa-chevron-right"></i></div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        // インフルエンサーのプロジェクト作成の必須項目はこちらに追加してください
        const projectFields = {
            title: 'プロジェクト名',
            content: 'プロジェクト概要文',
            start_date: '掲載開始日',
            end_date: '掲載終了日',
            reward_by_total_quantity: '支援人数順PSリターン内容',
            // NOTE: こちらは支援総額順のリターンを使用する際にコメントアウトを解除してください。
            // reward_by_total_amount : '支援総額順リターン内容',
        }
        const planFields = {
            title: 'リターン名',
            content: 'リターン詳細',
        }
        const profileFields = {
            last_name: '姓',
            first_name: '名',
            last_name_kana: '姓（カナ）',
            first_name_kana: '名（カナ）',
        }
        const addressFields = {
            city: '市区町村',
            block: '町域',
            block_number: '番地',
        }
        const bankAccountFields = {
            Bank_Code: '金融機関コード / 銀行コード',
            Branch_Name: '支店番号',
            Account_Number: '口座番号',
            Account_Name: '口座名義',
        }

        const applySubmit = (
            project,
            plans,
            tags,
            profile,
            address,
            identification,
            bankAccount
            ) => {

            let requiredFields = [];

            const getRequiredFields = (fields, table) => {
                for (let key in fields) {
                    let field = '・' + fields[key] + '\n';
                    table[key] === '' && requiredFields.push(field);
                }
            }

            // プロジェクト
            if (project['target_number'] < 1)
                requiredFields.push('・目標金額\n');
            getRequiredFields(projectFields, project);

            // リターン
            if (plans.length === 0)
                requiredFields.push('・リターンを1つ以上作成してください\n');

            for (let i = 0; i < plans.length; i++) {
                for (let key in planFields) {
                    let field = '・' + (i + 1) + '番目の' + planFields[key] + '\n';
                    plans[i][key] === '' && requiredFields.push(field);
                }
                if (plans[i]['price'] < 1)
                    requiredFields.push('・' + (i + 1) + '番目のリターン金額\n');
                if (plans[i]['image_url'] === 'public/sampleImage/now_printing.png')
                    requiredFields.push('・' + (i + 1) + '番目のリターン画像\n');
            }

            // タグ
            if (tags.length < 1)
                requiredFields.push('・タグを1つ以上設定してください\n');

            // プロフィール
            getRequiredFields(profileFields, profile);
            if (profile['phone_number'] === '00000000000')
                requiredFields.push('・電話番号\n');

            // アドレス
            getRequiredFields(addressFields, address);
            if (address['postal_code'] === '0')
                requiredFields.push('・郵便番号\n');

            // 本人確認
            if (
                identification['identify_image_1'] === 'public/sampleImage/now_printing.png'
                && identification['identify_image_2'] === 'public/sampleImage/now_printing.png'
            )
                requiredFields.push('・本人確認書類\n');

            // 銀行口座
            if (bankAccount === null) {
                requiredFields.push('・銀行口座情報を入力してください\n');
            } else {
                getRequiredFields(bankAccountFields, bankAccount);
            }

            // 配列に入った必須項目フィールドを一つの文字列にまとめる
            let joinedRequiredFields = requiredFields.join('');

            if (requiredFields.length === 0) {
                confirm('申請してもよろしいですか？') && document.getElementById('apply_form').submit();
            } else {
                let validationMessage = '下記の項目を正しく入力してから申請してください。\n' + joinedRequiredFields;
                alert(validationMessage);
            }
        }
    </script>
@endsection
