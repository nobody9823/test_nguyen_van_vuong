<form action="{{ route('user.project.update', ['project' => $project, 'current_tag' => 'target_amount']) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form_item_row">
        <div class="form_item_tit">目標金額<span class="hissu_txt">必須</span></div>
        <input type="number" name="target_amount" class="p-postal-code def_input_100p"
        value="{{ old('target_amount', optional($project)->target_amount) }}" placeholder="（例）100000">
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">掲載開始日(日付、時刻)<span class="hissu_txt">必須</span><small class="date_attention" style="font-size: 5px;color:rgb(139, 139, 139)">存在しない日付は選択できません。</small></div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_year" class="form-control" name="start_year" readonly required onchange="dateValidation(this, 'start_year', 'start_month', 'start_day')">
                <option value='' disabled selected style='display:none;'>年</option>
                @for($i = (int) date('Y'); $i <= (int) date('Y') + 2; $i ++)
                <option value="{{ $i }}"
                    {{ old('start_year', optional(optional($project)->start_date)->year) == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_month" class="form-control" name="start_month" onchange="dateValidation(this, 'start_year', 'start_month', 'start_day')">
                <option value='' disabled selected style='display:none;'>月</option>
                @for ($i = 1; $i <= 12; $i++) 
                <option value="{{ sprintf('%02d', $i) }}"
                    {{ old('start_month', optional(optional($project)->start_date)->month) == sprintf('%02d', $i) ? 'selected' : '' }}>
                    {{ $i }}
                </option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_day" class="form-control" name="start_day" onchange="dateValidation(this, 'start_year', 'start_month', 'start_day')">
                <option value='' disabled selected style='display:none;'>日</option>
                @for ($i = 1; $i <= date('d', strtotime('last day of' . now())); $i++)
                <option
                    value="{{ sprintf('%02d', $i) }}"
                    {{ old('start_day', optional(optional($project)->start_date)->day) == sprintf('%02d', $i) ? 'selected' : '' }}>
                    {{ $i }}
                </option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="hour" class="form-control" name="start_hour">
                <option value='' disabled selected style='display:none;'>時</option>
                @for ($i = 0; $i <= 23; $i++) <option value="{{ sprintf('%02d', $i) }}"
                    {{ old('start_hour', optional(optional($project)->start_date)->hour) == sprintf('%02d', $i) ? 'selected' : '' }}>
                    {{ $i }}</option>
                    @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal">
            <select id="minute" class="form-control" name="start_minute">
                <option value='' disabled selected style='display:none;'>分</option>
                @for ($i = 0; $i <= 59; $i++) <option value="{{ sprintf('%02d', $i) }}"
                    {{ old('start_minute', optional(optional($project)->start_date)->minute) == sprintf('%02d', $i) ? 'selected' : '' }}>
                    {{ $i }}</option>
                    @endfor
            </select>
        </div>
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">掲載終了日(日付、時刻)<span class="hissu_txt">必須</span><small class="date_attention" style="font-size: 5px;color:rgb(139, 139, 139)">存在しない日付は選択できません。</small></div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_year" class="form-control" name="end_year" readonly onchange="dateValidation(this, 'end_year', 'end_month', 'end_day')">
                <option value='' disabled selected style='display:none;'>年</option>
                @for($i = (int) date('Y'); $i <= (int) date('Y') + 2; $i ++) 
                <option value="{{ $i }}"
                    {{ old('end_year', optional(optional($project)->end_date)->year) == $i ? 'selected' : '' }}>{{ $i }}
                </option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_month" class="form-control" name="end_month" onchange="dateValidation(this, 'end_year', 'end_month', 'end_day')">
                <option value='' disabled selected style='display:none;'>月</option>
                @for ($i = 1; $i <= 12; $i++) 
                <option value="{{ sprintf('%02d', $i) }}"
                    {{ old('end_month', optional(optional($project)->end_date)->month) == sprintf('%02d', $i) ? 'selected' : '' }}>
                    {{ $i }}
                </option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_day" class="form-control" name="end_day" onchange="dateValidation(this, 'end_year', 'end_month', 'end_day')">
                <option value='' disabled selected style='display:none;'>日</option>
                @for ($i = 1; $i <= date('d', strtotime('last day of' . now())); $i++) 
                <option
                    value="{{ sprintf('%02d', $i) }}"
                    {{ old('end_day', optional(optional($project)->end_date)->day) == sprintf('%02d', $i) ? 'selected' : '' }}>
                    {{ $i }}
                </option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="hour" class="form-control" name="end_hour">
                <option value='' disabled selected style='display:none;'>時</option>
                @for ($i = 0; $i <= 23; $i++) 
                <option value="{{ sprintf('%02d', $i) }}"
                    {{ old('end_hour', optional(optional($project)->end_date)->hour) == sprintf('%02d', $i) ? 'selected' : '' }}>
                    {{ $i }}
                </option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal">
            <select id="minute" class="form-control" name="end_minute">
                <option value='' disabled selected style='display:none;'>分</option>
                @for ($i = 0; $i <= 60; $i++) 
                <option value="{{ sprintf('%02d', $i) }}"
                    {{ old('end_minute', optional(optional($project)->end_date)->minute) == sprintf('%02d', $i) ? 'selected' : '' }}>
                    {{ $i }}
                </option>
                @endfor
            </select>
        </div>
        <div class="def_btn">
            <button type="submit" class="disable-btn">
                <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存する</p>
            </button>
        </div>
    </div>
</form>

<script src={{ asset('/js/blade-functions.js') }}></script>