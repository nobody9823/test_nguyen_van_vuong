{{--
    現在のgetパラメーターをhidden化して全てフォームに追加する用コンポーネント
    特別コンポーネント化する意味はないが、統一していると一気に見やすくなるはず。
    ※必ず他の検索関連入力欄(検索窓、ソート、絞り込み等)より上に記述する事！！2回目以降の検索が上手くいかなくなります。
--}}
{{--
@foreach (Request::query() as $key => $value)
<input type="hidden" name='{{ $key }}' value={{ $value }}>
@endforeach
--}}
<!-- 上記処理だと登録や更新処理で、Request::query()が無いというエラーが表示される為、暫定でコメントアウトしました。一旦下の処理で対応します。 -->
<input type="hidden" name='project' value='{{ $project }}'>