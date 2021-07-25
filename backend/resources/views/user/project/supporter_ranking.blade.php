@extends('user.layouts.base')

@section('content')
    <x-user.supporter-ranking :project="$project" :usersRankedByTotalAmount="$users_ranked_by_total_amount" :usersRankedByTotalQuantity="$users_ranked_by_total_quantity"/>
@endsection
