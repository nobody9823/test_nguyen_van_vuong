<form action="{{ route('user.project.update', ['project' => $project, 'current_tab' => 'visual']) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="form_item_row">
    <div class="form_item_tit">スライド画像変更<span class="nini_txt">任意</span></div>

    @foreach($projectImages as $project_image)
        <div style="width: 50%;">
            <div>
                <div class="ib02_01 E-font my_project_img_wrapper">
                    <img src="{{ Storage::url($project_image->file_url) }}">
                </div>
                <input type="file" onChange="uploadProjectImage(this, {{ $project->id }}, {{ $project_image->id }})">
            </div>
        </div>
    @endforeach
</div>
<div class="form_item_row">
    <div style="width: 50%;">
        <div>
            <div class="form_item_tit">スライド画像追加<span class="nini_txt">任意</span></div>
            <input type="file" onChange="uploadProjectImage(this, {{ $project->id }})">
        </div>
    </div>
</div>


<div class="form_item_row">
    <div class="form_item_tit">スライドYouTube動画URL設定</div>
    <input type="text" name="video_url" class="def_input_100p" value="{{ old('video_url', optional($projectVideo)->file_url) }}">
</div>

<x-common.save_back_button />
</form>
