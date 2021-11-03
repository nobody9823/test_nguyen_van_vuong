@extends('user.layouts.base')

@section('content')
    @if($project)
    <x-common.preview />
    @else
    <x-common.sample />
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
