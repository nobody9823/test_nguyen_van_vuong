@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="section">

        <x-user.mypage-navigation-bar />

        <div class="fixedcontainer mypage_contents taikai_box">
            <h2><i class="fas fa-heart"></i>お気に入りプロジェクト一覧</h2>
            
            <div class="project-list my-page_project-list">
                <x-user.project-card :projects="$projects" mypage="mypage" />
            </div>
        </div>
   </div>
</div>
@endsection