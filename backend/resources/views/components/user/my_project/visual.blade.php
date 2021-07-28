<div class="form_item_row" style="margin-bottom: 40px;">
    <div class="form_item_tit">スライド画像追加<span class="nini_txt">任意</span></div>
    <input type="file" onChange="uploadProjectImage(this, {{ $project->id }})">
</div>

<div class="form_item_row project_image_row">
    <div class="form_item_tit">スライド画像変更<span class="nini_txt">任意</span></div>

    @foreach($projectImages as $project_image)
        <div>
            <div class="ib02_01 E-font my_project_img_wrapper">
                <img id="project_file_{{ $project_image->id }}" src="{{ Storage::url($project_image->file_url) }}">
            </div>
            <input style="margin-bottom: 40px;" type="file" onChange="uploadProjectImage(this, {{ $project->id }}, {{ $project_image->id }})">
        </div>
    @endforeach
</div>

<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'visual']) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form_item_row">
        <div class="form_item_tit">スライドYouTube動画URL設定</div>
        <input type="text" name="video_url" class="def_input_100p" value="{{ old('video_url', optional($projectVideo)->file_url) }}">
    </div>

    <div class="def_btn">
        <button type="submit" class="disable-btn">
            {{-- FIXME: 動画URLの方は保存ボタンを押さないと保存できないのでボタン名を変えています。 --}}
            <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">動画URLを保存する</p>
        </button>
    </div>

    <div class="def_btn">
        <a style="font-size: 1.8rem;font-weight: bold;color: #fff; display: block" href="{{ route('user.my_project.project.index') }}">
            プロジェクト一覧へ戻る
        </a>
    </div>
</form>
