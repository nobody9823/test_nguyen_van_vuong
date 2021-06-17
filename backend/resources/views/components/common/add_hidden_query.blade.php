{{--
    現在のgetパラメーターをhidden化して全てフォームに追加する用コンポーネント
    特別コンポーネント化する意味はないが、統一していると一気に見やすくなるはず
--}}
@foreach (Request::query() as $key => $value)
<input type="hidden" name='{{ $key }}' value={{ $value }}>
@endforeach
