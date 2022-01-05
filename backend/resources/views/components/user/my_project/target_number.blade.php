<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'target_number']) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form_item_row">
        <div class="form_item_tit">
            目標金額<span class="hissu_txt">必須</span>
            <br/>
            <span class="disclaimer">
                ※目標金額は最低1円以上設定してください。
            </span>
        </div>
        <input type="number" name="target_number" class="p-postal-code def_input_100p"
            value="{{ old('target_number', optional($project)->target_number) }}" placeholder="（例）1000" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="target_number" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">
            募集方式<span class="hissu_txt">必須</span>
            <br/>
            <div class="tab_container funded_type_wrapper">
                <input type="radio" id="funded_type_all_in" name="funded_type" value="AllIn" oninput="updateMyProject.textInput(this, {{ $project->id }})"
                    @if(old('funded_type') === 'AllIn')
                        checked
                    @elseif(optional($project)->funded_type === 'AllIn')
                        checked
                    @endif
                />
                <label class="tab_item" for="funded_type_all_in">
                    All-In 方式
                    <br/>
                    目標金額を達成しなかったとしても、支援金が発生します。
                    <br/>
                    <span class="disclaimer prof_edit_editbox_desc">
                        ※支援者1名からリターン実行の義務が生じます。
                    </span>
                </label>
                <input type="radio" id="funded_type_all_or_nothing" name="funded_type" value="AllOrNothing" oninput="updateMyProject.textInput(this, {{ $project->id }})"
                    @if(old('funded_type') === 'AllOrNothing')
                        checked
                    @elseif(optional($project)->funded_type === 'AllOrNothing')
                        checked
                    @endif
                />
                <label class="tab_item" for="funded_type_all_or_nothing">
                    All-or-Nothing 方式
                    <br/>
                    目標金額を達成した場合、支援金を受け取れます。
                    <br/>
                    <span class="disclaimer prof_edit_editbox_desc">
                        ※目標金額が達成した場合、リターン実行義務が生じます。
                    </span>
                </label>
            </div>
        </div>
        <x-common.async-submit-message propName="funded_type" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">
            掲載開始日(日付、時刻)
            <span class="hissu_txt">必須</span>
            <br/>
            {{-- <span class="disclaimer">
                ※審査期間があるため、2週間以降の日付を設定してください。
            </span> --}}
        </div>
        <input type="text" id="start_date" name="start_date" class="p-postal-code def_input_100p"
            value="{{ old('start_date', optional($project)->start_date) }}" placeholder="（例）100000" oninput="updateMyProject.textInput(this, {{ $project->id }}), onInputStartDate()">
        <x-common.async-submit-message propName="start_date" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">
            掲載終了日(日付、時刻)
            <span class="hissu_txt">必須</span>
            <br/>
            <span class="disclaimer">
                ※先に掲載開始日を設定して下さい。
            </span>
            <br/>
            <span class="disclaimer prof_edit_editbox_desc">
                ※掲載期間は最長50日未満で設定してください
            </span>
        </div>
        <input type="text" id="end_date" name="end_date" class="p-postal-code def_input_100p"
            value="{{ old('end_date', optional($project)->end_date) }}" placeholder="（例）100000" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="end_date" />
    </div>
    <x-common.navigating_page_buttons :project="$project" />
</form>
