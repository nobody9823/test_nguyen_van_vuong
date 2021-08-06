@php
use Carbon\Carbon;
@endphp

@extends('user.layouts.base')

@section('content')
<x-common.preview />
<x-user.project.show :project="$project" :inviterCode="null" />
@endsection

@section('script')
<script src="{{ asset('/js/pointer-events.js') }}"></script>
@endsection
