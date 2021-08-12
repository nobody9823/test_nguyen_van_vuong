@extends('user.layouts.base')

@section('content')
    <x-common.sample />
    <x-user.supporter-ranking :project="null" :usersRankedByTotalAmount="null" :usersRankedByTotalQuantity="null"/>
@endsection

@section('script')
    <script src="{{ asset('/js/pointer-events.js') }}"></script>
@endsection
