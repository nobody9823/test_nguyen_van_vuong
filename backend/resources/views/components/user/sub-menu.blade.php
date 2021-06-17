<div class="header_submenu" style="display: none;">
    <div class="fixedcontainer">
        <p class="fixedcontainer_btn">
            <a href="{{ route('user.search', ['sort_type' => 0]) }}" class="f_b_01"><span>人気のプロジェクト</span><i class="fas fa-caret-right"></i></a>
            <a href="{{ route('user.search', ['sort_type' => 1]) }}" class="f_b_01"><span>注目の新着プロジェクト</span><i class="fas fa-caret-right"></i></a>
            <a href="{{ route('user.search', ['sort_type' => 2]) }}" class="f_b_01"><span>募集終了が近いプロジェクト</span><i class="fas fa-caret-right"></i></a>
            <a href="{{ route('user.search', ['holding_check' => 0]) }}" class="f_b_01"><span>もうすぐ公開されます</span><i class="fas fa-caret-right"></i></a>
        </p>
        <ul>
            @foreach($categories() as $key => $category)
            <li><a href="{{ route('user.search', ['category_id' => $key]) }}">{{ $category }}</a></li>
            @endforeach
        </ul>
        <a href="/search" class="f_b_02"><span>全てのプロジェクトを見る</span><i class="fas fa-caret-right"></i></a>
    </div>
</div>