@extends('user.layouts.base')

@section('content')
<x-user.plan.show :project="$project" :plan="$plan" />
@endsection
