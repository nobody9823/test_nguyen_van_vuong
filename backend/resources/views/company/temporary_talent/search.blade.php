@extends('company.layouts.base')
@section('title','検索結果')
@section('content')

<!-- エラーや操作完了のメッセージ -->
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">{{$word}} の検索結果(全{{count($props)}}件)</div>
    <form action="{{ route('company.temporary_talent.search') }}" class="form-inline pr-3" method="post">
        @csrf
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
</div>
</div>

<div class="card-body">
    @if(count($props) <= 0) <p>承認待ちタレントは存在しません。</p>
        @else
        <table class="table temporary_talent_list">
            <tr>
                <th>タレント名</th>
                <th>メールアドレス</th>
                <th>詳細</th>
                <th>承認</th>
                <th>拒否</th>
            </tr>
            @foreach($props as $prop)
            <tr class="temporary_talent">
                <td>{{ $prop->name }}</td>
                <td>{{ $prop->email }}</td>
                <td><a href="/company/temporary_talent/{{ $prop }}" class="btn btn-primary btn-sm">詳細</a></td>
                <td>
                    <form action="{{ route('company.temporary_talent.accept', ['temporary_talent' => $prop]) }}"
                        method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-success btn-sm btn-accept">承認</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('company.temporary_talent.reject', ['temporary_talent' => $prop]) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-reject">拒否</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="row justify-content-center mb-5">
            <a class="btn btn-primary" id="more_btn">もっと見る</a>
            <a class="btn btn-primary" id="closed_btn">閉じる</a>
            <a class="btn btn-primary ml-4" href="{{ route('company.temporary_talent.index') }}" role="button">Topへ戻る</a>
        </div>
        @endif
</div>
@section('script')
<script>
    $(function(){
    $(".btn-reject").click(function(){
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
        // 承認前ユーザーの数を取得
        var $temporary_talent_length = $('.temporary_talent').length;

        // 承認前ユーザーを12コまで取得
        var $default_num = 12;

        // もっと見るボタンを押すとさらに12コ表示
        var $add_num = 12;

        // 現在の承認前ユーザーの表示数
        var $current_num = 0;

        // $current_numに初期値を代入
        $current_num = $default_num;

        $("document").ready(function() {

            // 取得した承認前ユーザー数が$current_numより多い時
            if ($current_num < $temporary_talent_length) {
                // 承認前ユーザーを12コまで表示してそれ以外はhideしておく
                $('.temporary_talent').each(function(index, element) {
                    if (index >= $default_num) {
                        $(this).hide();
                    }
                })

                // もっと見るボタンは表示して、閉じるボタンはhideする
                $("#more_btn").show();
                $("#closed_btn").hide();
                // 取得した承認前ユーザー数が$current_numより少ない時
            } else if ($current_num >= $temporary_talent_length) {
                // もっと見るボタンと閉じるボタンをhideする
                $("#more_btn").hide();
                $("#closed_btn").hide();
            }

            // もっと見るボタンを押した時
            $("#more_btn").click(function() {
                // $current_num変数を更新
                $current_num += $add_num;
                // 現在表示している承認前ユーザーに12コ追加で表示
                $(".temporary_talent_list").find(".temporary_talent:lt("+ $current_num +")").slideDown();

                // $current_numより取得した承認前ユーザーが少ない場合
                if ($current_num >= $temporary_talent_length) {
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
                        $(".temporary_talent_list").find(".temporary_talent:gt("+ $index_num +")").slideUp();
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
