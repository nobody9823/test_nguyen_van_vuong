@extends('user.layouts.base')

@section('content')
    @if($project)
    <x-common.preview />
    @else
    <x-common.label text="サンプル表示中です。" />
    @endif

    <x-user.supporter-ranking
        :project="$project"
        :usersRankedByTotalAmount="null"
        :usersRankedByTotalQuantity="null"
    />

@endsection

@section('script')
    <script src="{{ asset('/js/pointer-events.js') }}"></script>
@endsection
