<form action="{{ route('user.project.update', ['project' => $project, 'current_tab' => 'overview']) }}" method="post">
    @csrf
    @method('PUT')
<div class="form_item_row">
    <div class="form_item_tit">タイトル<span class="hissu_txt">必須</span></div>
    <input type="text" name="title" class="def_input_100p" value="{{ old('title', optional($project)->title) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">概要文<span class="nini_txt">任意</span>　<span style="font-weight: normal;font-size: 1.2rem;">※300文字以内で入力してください</span></div>
    <textarea name="content" class="def_textarea tiny_editor" rows="6">{{ old('content', optional($project)->content) }}</textarea>
</div>

<div class="form_item_row">
    <div class="form_item_tit">タグ<span class="hissu_txt">必須</span></div>
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

<x-common.save_back_button />
</form>
