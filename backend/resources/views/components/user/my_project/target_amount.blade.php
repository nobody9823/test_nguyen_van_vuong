<form action="{{ route('user.project.update', ['project' => $project]) }}" method="post">
    @csrf
    @method('PUT')
<div class="form_item_row">
        <div class="form_item_tit">目標金額<span class="hissu_txt">必須</span></div>
        <input type="number" name="target_amount" class="p-postal-code def_input_100p" value="{{ old('target_amount', optional($project)->target_amount) }}" placeholder="（例）100000">
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">掲載開始日(日付、時刻)<span class="hissu_txt">必須</span></div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_year" class="form-control" name="start_year" readonly>
            @for($i = (int) date('Y'); $i <= (int) date('Y') + 2; $i ++)
                <option value="{{ $i }}" {{ old('start_year', optional(optional($project)->start_date)->year) == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_month" class="form-control" name="start_month">
                @for ($i = 0; $i <= 12; $i++)
                <option value="{{ sprintf('%02d', $i) }}" {{ old('start_month', optional(optional($project)->start_date)->month) == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_day" class="form-control" name="start_day">
                @for ($i = 0; $i <= date('d', strtotime('last day of' . now())); $i++)
                <option value="{{ sprintf('%02d', $i) }}" {{ old('start_day', optional(optional($project)->start_date)->day) == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="hour" class="form-control" name="start_hour">
                @for ($i = 0; $i <= 23; $i++)
                <option value="{{ sprintf('%02d', $i) }}" {{ old('start_hour', optional(optional($project)->start_date)->hour) == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" >
            <select id="minute" class="form-control" name="start_minute">
                @for ($i = 0; $i <= 59; $i++)
                <option value="{{ sprintf('%02d', $i) }}" {{ old('start_minute', optional(optional($project)->start_date)->minute) == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">掲載終了日(日付、時刻)<span class="hissu_txt">必須</span></div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_year" class="form-control" name="end_year" readonly>
            @for($i = (int) date('Y'); $i <= (int) date('Y') + 2; $i ++)
                <option value="{{ $i }}" {{ old('end_year', optional(optional($project)->end_date)->year) == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_month" class="form-control" name="end_month">
            @for ($i = 0; $i <= 12; $i++)
                <option value="{{ sprintf('%02d', $i) }}" {{ old('end_month', optional(optional($project)->end_date)->month) == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_day" class="form-control" name="end_day">
            @for ($i = 0; $i <= date('d', strtotime('last day of' . now())); $i++)
                <option value="{{ sprintf('%02d', $i) }}" {{ old('end_day', optional(optional($project)->end_date)->day) == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="hour" class="form-control" name="end_hour">
                @for ($i = 0; $i <= 23; $i++)
                <option value="{{ sprintf('%02d', $i) }}" {{ old('end_hour', optional(optional($project)->end_date)->hour) == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" >
            <select id="minute" class="form-control" name="end_minute">
                @for ($i = 0; $i <= 60; $i++)
                <option value="{{ sprintf('%02d', $i) }}" {{ old('end_minute', optional(optional($project)->end_date)->minute) == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
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