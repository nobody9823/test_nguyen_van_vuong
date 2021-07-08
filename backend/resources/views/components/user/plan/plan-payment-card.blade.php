<!-- <div class="as_select_return asr_current" id="plan_card_{{$plan->id }}"> -->
<div class="as_select_return" id="plan_card_{{$plan->id }}">
    <div class="def_inner inner_item">
        <div class="wlr_64">
            <div class="wlr_64_L">
                <div class="as_img">
                    <img class="" src="{{ Storage::url($plan->image_url) }}">
                </div>
            </div><!--/wlr_64_L-->

            <div class="wlr_64_R">
                <div class="as_01">
                    <div class="as_check">
                        <input type="checkbox" name="plan_ids[]" class="plan_ids ac_list_checks checkbox-fan" onChange="Plans.planIsChecked(this)" id="{{ $plan->id }}" value="{{ $plan->price }}" {{ ($plan->limit_of_supporters > 0) === false ? 'disabled' : '' }}>
                        <label for="{{ $plan->id }}" class="checkbox-fan_02">{{ $plan->price }}円</label>
                    </div>
                </div>
                @if ($plan->limit_of_supporters > 0)
                    <div class="as_02">
                        <div class="cp_ipselect_02 cp_chb ">
                            <select name="plans[{{$plan->id}}]amount[]" id="plan_amount_{{ $plan->id }}" onChange="Plans.planAmountIsChanged(this)" disabled>
                                @for($i = 1; $i <= $plan->limit_of_supporters; $i ++)
                                    <option value="{{ $i }}">数量{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div><!--/-->
                @endif

                <div class="as_tit">{{ $plan->title }}</div><!--/-->

                <div class="as_txt">{{ $plan->content }}</div>

                <div class="as_03">
                    <div class="as_shien_nin">支援者 <span>{{ $plan->includedPayments->count() }}人</span></div>
                    <div class="as_day">お届け予定 <span>{{ $plan->delivery_date }}</span></div>
                </div>
            </div><!--/wlr_64_R-->
        </div><!--/wlr_64-->
    </div><!--/def_inner-->
</div><!--/as_select_return-->
