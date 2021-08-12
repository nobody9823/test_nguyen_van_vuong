<form action={{route('user.search')}} name="searchProjectForm">
    @csrf
    <div class="filter_wrapper">
        <div class="filter_tags_wrapper">
            <input class="filter_tags_open_input" type="checkbox" id="filter_tags_open" />
            <label class="filter_item_green_base filter_tags_open_label" for="filter_tags_open">
                @if(isset($tag_id) && $tag_id !== 'undefined')
                <span>{{ $tags()[$tag_id] }}</span>
                @else
                <span>カテゴリーで絞り込む</span>
                @endif
                <div class="filter_item_arrow_wrapper">
                    <div class="filter_item_arrow_top"></div>
                    <div class="filter_item_arrow_bottom"></div>
                </div>
            </label>
            <div class="filter_tags_items">
            @if(isset($tag_id) && $tag_id !== 'undefined')
                <input class="filter_tags_radio" type="radio" name="tag_id" value="" id="filter_tags_radio_default" onchange="selectedRadioButtonHandler()"/>
                <label class="filter_item_green_base filter_item_radio_label" for="filter_tags_radio_default">
                    <div class="filter_checked"></div>
                    <span>カテゴリーで絞り込む</span>
                </label>
            @endif
            @foreach($tags() as $id => $name)
                <input class="filter_tags_radio" type="radio" name="tag_id" value="{{ $id }}" id="filter_tags_radio_{{ $id }}" {{ $tag_id == $id  ? 'checked' : '' }} onchange="selectedRadioButtonHandler()"/>
                <label class="filter_item_green_base filter_item_radio_label" for="filter_tags_radio_{{ $id }}">
                    <div class="filter_checked"></div>
                    <span>{{ $name }}</span>
                </label>
            @endforeach
            </div>
        </div>
        <input class="filter_sort_type_open_input" type="checkbox" id="filter_sort_type_open" {{ isset($sort_type)  ? 'checked' : '' }}/>
        <label class="filter_item_green_base filter_sort_type_open_label" for="filter_sort_type_open">
            <div class="filter_wrapper_is_close">
                <span>さらに絞り込む</span>
                <div class="filter_item_icon filter_item_icon--plus">
                    <span class="filter_item_icon__mark"></span>
                </div>
            </div>
            <div class="filter_wrapper_is_open">
                <span>閉じる</span>
                <div class="filter_item_icon">
                    <span class="filter_item_icon__mark"></span>
                </div>
            </div>
        </label>
        <div class="filter_sort_type_wrapper">
            <input class="filter_sort_type_radio" type="radio" name="sort_type" value="0" id="filter_sort_type_radio_0" {{ $sort_type === '0'  ? 'checked' : '' }} onchange="selectedRadioButtonHandler()"/>
            <label class="filter_item_white_base" for="filter_sort_type_radio_0">
                <span>人気順</span>
            </label>
            <input class="filter_sort_type_radio" type="radio" name="sort_type" value="1" id="filter_sort_type_radio_1" {{ $sort_type === '1'  ? 'checked' : '' }} onchange="selectedRadioButtonHandler()"/>
            <label class="filter_item_white_base" for="filter_sort_type_radio_1">
                <span>新着順</span>
            </label>
            <input class="filter_sort_type_radio" type="radio" name="sort_type" value="2" id="filter_sort_type_radio_2" {{ $sort_type === '2'  ? 'checked' : '' }} onchange="selectedRadioButtonHandler()"/>
            <label class="filter_item_white_base" for="filter_sort_type_radio_2">
                <span>終了日が近い順</span>
            </label>
            <input class="filter_sort_type_radio" type="radio" name="sort_type" value="3" id="filter_sort_type_radio_3" {{ $sort_type === '3'  ? 'checked' : '' }} onchange="selectedRadioButtonHandler()"/>
            <label class="filter_item_white_base" for="filter_sort_type_radio_3">
                <span>支援総額順</span>
            </label>
            <input class="filter_sort_type_radio" type="radio" name="sort_type" value="4" id="filter_sort_type_radio_4" {{ $sort_type === '4'  ? 'checked' : '' }} onchange="selectedRadioButtonHandler()"/>
            <label class="filter_item_white_base" for="filter_sort_type_radio_4">
                <span>支援者数順</span>
            </label>
        </div>
        {{-- <div class="filter_item_green_base filter_add_conditions">
            <span>さらに条件を追加</span>
            <div class="filter_item_icon filter_item_icon--plus">
                <span class="filter_item_icon__mark"></span>
            </div>
        </div> --}}
    </div>
</form>
