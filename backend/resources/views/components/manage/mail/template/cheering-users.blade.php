@extends('admin.layouts.mail_template')

@section('content')
<p>
    {{ $user->name }}様
</p>
<p style="white-space: pre-line;">
    {{ $description }}
</p>
@endsection
