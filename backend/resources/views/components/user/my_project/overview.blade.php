<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'overview']) }}" method="post">
    @csrf
    @method('PUT')
<div class="form_item_row">
    <div class="form_item_tit">
        プロジェクト名
        <span class="hissu_txt">必須</span>
    </div>
    <input type="text" name="title" class="def_input_100p" value="{{ old('title', optional($project)->title) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <x-common.async-submit-message propName="title" />
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        <span>概要文</span>
        <span class="hissu_txt">必須</span>
        <p class="disclaimer">※動画の埋め込みはスマートフォンからはできません。PCから埋め込みをお願いします。</p>
    </div>
    <textarea name="content" id="content" class="def_textarea tiny_editor" rows="6">{{ old('content', optional($project)->content) }}</textarea>
    <x-common.async-submit-message propName="content" />
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
    <x-common.async-submit-message propName="tags" />
</div>

<x-common.navigating_page_buttons />
</form>
