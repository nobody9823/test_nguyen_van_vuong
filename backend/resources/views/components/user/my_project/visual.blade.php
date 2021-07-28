<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'visual']) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="form_item_row">
    <div class="form_item_tit">スライド画像設定<span class="nini_txt">任意</span></div>

    @for($i = 0; $i <= 4; $i ++)
        <div style="width: 50%;">
            @if(optional($projectImages)[$i] !== null)
                <input type="checkbox" id="{{ $i }}" class="ac_list_checks" name="file_ids[]" value="{{ $projectImages[$i]['id'] }}" onClick="displayInputFile(this)">
                <label for="{{ $i }}" class="checkbox-fan">画像{{ $i +1 }}</label>
            @endif
            <div>
                <div class="ib02_01 E-font my_project_img_wrapper">
                    @if(optional($projectImages)[$i] !== null)
                        <img src="{{ Storage::url($projectImages[$i]['file_url']) }}">
                    @endif
                </div>
                <input type="file" name="visual_image_url[{{ optional(optional($projectImages)[$i])['id'] }}][]" id="project_image_{{ $i }}" style="{{ optional($projectImages)[$i] !== null ? 'display: none;' : '' }}">
            </div>
        </div>
    @endfor
</div>

<div class="form_item_row">
    <div class="form_item_tit">スライドYouTube動画URL設定</div>
    <input type="text" name="video_url" class="def_input_100p" value="{{ old('video_url', optional($projectVideo)->file_url) }}">
</div>

<x-common.save_back_button />
</form>
