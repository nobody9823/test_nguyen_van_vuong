@extends('company.layouts.base')
@section('title','検索結果')
@section('content')

<!-- エラーや操作完了のメッセージ -->
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">{{$word}} の検索結果(全{{count($props)}}件)</div>
    <form action="{{ route('company.talent.search') }}" class="form-inline pr-3" method="post">
        @csrf
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    <div class="text-right">
        <a href="{{ route('company.talent.create') }}" class="btn btn-outline-success">新規作成</a>
    </div>
</div>

<div class="card-body">
    @if(count($props) <= 0) <p>会社データがありません。</p>
        @else
        <table class="table talent_list">
            <tr>
                <th>社名</th>
                <th>メールアドレス</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            @foreach($props as $prop)
            <tr class="talent">
                <td>{{ $prop->name }}</td>
                <td>{{ $prop->email }}</td>
                <td><a class="btn btn-primary btn-sm"
                        href="{{route('company.talent.edit',['talent' => $prop])}}">編集</a>
                <td>
                    <form action="{{route('company.talent.destroy',['talent' => $prop])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="row justify-content-center mb-5">
            <a class="btn btn-primary" id="more_btn">もっと見る</a>
            <a class="btn btn-primary" id="closed_btn">閉じる</a>
            <a class="btn btn-primary ml-4" href="{{ route('company.talent.index') }}" role="button">Topへ戻る</a>
        </div>
        @endif
</div>
@section('script')
<script>
    $(function(){
    $(".btn-dell").click(function(){
    if(confirm("本当に削除しますか？")){
    //そのままsubmit（削除）
    }else{
    //cancel
    return false;
    }
    });
    });
</script>

<script>
    $(function() {
        // タレントの数を取得
        var $talent_length = $('.talent').length;

        // タレントを12コまで取得
        var $default_num = 12;

        // もっと見るボタンを押すとさらに12コ表示
        var $add_num = 12;

        // 現在のタレントの表示数
        var $current_num = 0;

        // $current_numに初期値を代入
        $current_num = $default_num;

        $("document").ready(function() {

            // 取得したタレント数が$current_numより多い時
            if ($current_num < $talent_length) {
                // タレントを12コまで表示してそれ以外はhideしておく
                $('.talent').each(function(index, element) {
                    if (index >= $default_num) {
                        $(this).hide();
                    }
                })

                // もっと見るボタンは表示して、閉じるボタンはhideする
                $("#more_btn").show();
                $("#closed_btn").hide();
                // 取得したタレント数が$current_numより少ない時
            } else if ($current_num >= $talent_length) {
                // もっと見るボタンと閉じるボタンをhideする
                $("#more_btn").hide();
                $("#closed_btn").hide();
            }

            // もっと見るボタンを押した時
            $("#more_btn").click(function() {
                // $current_num変数を更新
                $current_num += $add_num;
                // 現在表示しているタレントに12コ追加で表示
                $(".talent_list").find(".talent:lt("+ $current_num +")").slideDown();

                // $current_numより取得したタレントが少ない場合
                if ($current_num >= $talent_length) {
                    // $current_numをデフォルト値を代入
                    $current_num = $default_num;
                    // インデックス用の値をセット
                    var $index_num = $current_num - 1;
                    // もっと見るボタンをhideして、閉じるボタンを表示
                    $("#more_btn").hide();
                    $("#closed_btn").show();

                    // 閉じるボタンを押した時
                    $("#closed_btn").click(function() {
                        // インデックスが$index_numより大きい要素は非表示
                        $(".talent_list").find(".talent:gt("+ $index_num +")").slideUp();
                        // 閉じるボタンはhide、もっと見るボタンは表示
                        $("#closed_btn").hide();
                        $("#more_btn").show();
                    })
                }
            })
        })
    })
</script>

@endsection

@endsection
