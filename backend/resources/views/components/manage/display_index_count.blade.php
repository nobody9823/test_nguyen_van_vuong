{{--
一覧画面にて何件抽出したかを表示するコンポーネント
必要引数
props = 対象モデルを指定
--}}


@if (count($props) >0)
(全{{ $props->total() }}件
{{  ($props->currentPage() -1) * $props->perPage() + 1}} -
{{ (($props->currentPage() -1) * $props->perPage() + 1) + (count($props) -1)  }}件を表示)
@endif
