@extends('admin.layouts.base')
@section('title','検索結果')
@section('content')

<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">{{$word}} の検索結果(全{{count($props)}}件)</div>
    <form action="{{ route('admin.user.search') }}" class="form-inline pr-3" method="post">
        @csrf
        <input name="word" type="search" class="form-control" aria-level="Search" placeholder="キーワードで検索">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    <div class="text-right">
        <a href="{{ route('admin.user.create') }}" class="btn btn-outline-success mb-2">新規作成</a>
    </div>
</div>

<div class="card-body">
    @if(count($props) <= 0) <p>ユーザーデータがありません。</p>
        @else
        <table class="table user_list">
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            @foreach($props as $user)
            <tr class="user">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><a class="btn btn-primary btn-sm" href="{{ route('admin.user.edit',['user' => $user]) }}">編集</a>
                </td>
                <td>
                    <form action="{{route('admin.user.destroy',['user' => $user])}}" method="POST">
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
            <a class="btn btn-primary ml-4" href="{{ route('admin.user.index') }}" role="button">Topへ戻る</a>
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
        // ユーザーの数を取得
        var $user_length = $('.user').length;

        // ユーザーを８つまで取得
        var $default_num = 12;

        // もっと見るボタンを押すとさらに8つ表示
        var $add_num = 12;

        // 現在のユーザーの表示数
        var $current_num = 0;

        // $current_numに初期値を代入
        $current_num = $default_num;

        $("document").ready(function() {

            // 取得したユーザー数が$current_numより多い時
            if ($current_num < $user_length) {
                // ユーザーを８つまで表示してそれ以外はhideしておく
                $('.user').each(function(index, element) {
                    if (index >= $default_num) {
                        $(this).hide();
                    }
                })

                // もっと見るボタンは表示して、閉じるボタンはhideする
                $("#more_btn").show();
                $("#closed_btn").hide();
                // 取得したユーザー数が$current_numより少ない時
            } else if ($current_num >= $user_length) {
                // もっと見るボタンと閉じるボタンをhideする
                $("#more_btn").hide();
                $("#closed_btn").hide();
            }

            // もっと見るボタンを押した時
            $("#more_btn").click(function() {
                // $current_num変数を更新
                $current_num += $add_num;
                // 現在表示しているユーザーに８つ追加で表示
                $(".user_list").find(".user:lt("+ $current_num +")").slideDown();

                // $current_numより取得したユーザーが少ない場合
                if ($current_num >= $user_length) {
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
                        $(".user_list").find(".user:gt("+ $index_num +")").slideUp();
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
