@extends('user.layouts.base')

@section('content')
<x-common.preview />
<x-user.plan.show :project="$project" :plan="$plan" />
@endsection

@section('script')
<script src="{{ asset('/js/pointer-events.js') }}"></script>
@endsection
