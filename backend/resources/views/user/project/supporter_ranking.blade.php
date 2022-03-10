@extends('user.layouts.base')

@section('content')
    @if ($project->user->id === Auth::id())
        <x-common.label text="あなたのプロジェクトを支援したユーザー向けのプロジェクトサポーターランキングページです。
                    ボタンのクリックはできません。" />
    @endif
    <x-user.supporter-ranking :project="$project" :usersRankedByTotalAmount="$users_ranked_by_total_amount"
        :usersRankedByTotalQuantity="$users_ranked_by_total_quantity" />
@endsection
@section('script')
    <script src="{{ asset('/js/pointer-events.js') }}"></script>
@endsection