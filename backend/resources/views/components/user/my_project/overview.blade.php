<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'overview']) }}" method="post">
    @csrf
    @method('PUT')
<div class="form_item_row">
    <div class="form_item_tit">
        タイトル
        <span class="hissu_txt">必須</span>
    </div>
    <input type="text" name="title" class="def_input_100p" value="{{ old('title', optional($project)->title) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_title"></div>
        <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_title">保存しました</p>
        <span id="errors_title" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">概要文<span class="nini_txt">任意</span>　<span class="disclaimer">※300文字以内で入力してください</span></div>
    <textarea name="content" id="content" class="def_textarea tiny_editor" rows="6">{{ old('content', optional($project)->content) }}</textarea>
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_content"></div>
        <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_content">保存しました</p>
        <span id="errors_content" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">タグ<span class="hissu_txt">必須</span></div>
    <div onchange="updateMyProject.inputIsChecked(this, {{ $project->id }})">
    @foreach($tags as $key => $value)
        <input type="checkbox" id="{{ $value }}" class="ac_list_checks" name="tags[]" value="{{ $key }}"
            @if(old('tags'))
            {{ in_array($key, old('tags')) ? 'checked' : '' }}>
            @else
            {{ in_array($value, $project->tags->pluck('name')->toArray()) == $value ? 'checked' : '' }}>
            @endif
        <label for="{{ $value }}" class="checkbox-fan">{{ $value }}</label>
    @endforeach
    </div>
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_tags"></div>
        <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_tags">保存しました</p>
        <span id="errors_tags" style="color: red;"></span>
    </div>
</div>

<x-common.save_back_button />
</form>
