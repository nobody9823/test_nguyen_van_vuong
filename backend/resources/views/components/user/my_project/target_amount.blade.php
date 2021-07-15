<div class="form_item_row">
        <div class="form_item_tit">目標金額<span class="hissu_txt">必須</span></div>
        <input type="number" name="postal_code" class="p-postal-code def_input_100p" value="" placeholder="（例）100000">
    </div><!--/form_item_row-->

    <div class="form_item_row">
        <div class="form_item_tit">掲載開始日(日付、時刻)<span class="hissu_txt">必須</span></div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_year" class="form-control" name="birth_year" readonly>
                <option value="{{ date('Y') }}">{{ date('Y') }}</option>
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_month" class="form-control" name="birth_month">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ date('mm') == $i ? selected : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_day" class="form-control" name="birth_day">
                @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="hour" class="form-control" name="hour">
                @for ($i = 0; $i <= 23; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" >
            <select id="minute" class="form-control" name="minute">
                @for ($i = 0; $i <= 60; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div><!--/form_item_row-->

    <div class="form_item_row">
        <div class="form_item_tit">掲載終了日(日付、時刻)<span class="hissu_txt">必須</span></div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_year" class="form-control" name="birth_year" readonly>
                <option value="{{ date('Y') }}">{{ date('Y') }}</option>
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_month" class="form-control" name="birth_month">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ date('mm') == $i ? selected : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="birth_day" class="form-control" name="birth_day">
                @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
            <select id="hour" class="form-control" name="hour">
                @for ($i = 0; $i <= 23; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="cp_ipselect cp_normal" >
            <select id="minute" class="form-control" name="minute">
                @for ($i = 0; $i <= 60; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div><!--/form_item_row-->
