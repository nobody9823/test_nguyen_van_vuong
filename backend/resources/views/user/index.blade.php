@extends('user.layouts.base')

@section('content')
<div class="main">
    <div class="slider-for">
        <div style="background: url(image/main1.png) no-repeat;background-size: cover;background-position: center;">
        </div>
        <div style="background: url(image/main2.png) no-repeat;background-size: cover;background-position: center;">
        </div>
        <div style="background: url(image/main3.png) no-repeat;background-size: cover;background-position: center;">
        </div>
        <div style="background: url(image/main4.png) no-repeat;background-size: cover;background-position: center;">
        </div>
        <div style="background: url(image/main5.png) no-repeat;background-size: cover;background-position: center;">
        </div>
        <div style="background: url(image/main3.png) no-repeat;background-size: cover;background-position: center;">
        </div>
    </div>
    <div class="slider-nav">
        <div class="slider-nav-in">
            <div><img src="image/main1.png"></div>
            <div><img src="image/main2.png"></div>
            <div><img src="image/main3.png"></div>
            <div><img src="image/main4.png"></div>
            <div><img src="image/main5.png"></div>
            <div><img src="image/main3.png"></div>
        </div>
    </div>
    <h1 class="main_txt">I want to be the shinest <br class="visible-sp">among the all people.<br>Because my life is
        only one time.</h1>
</div>
<div class="content">
    <x-user.project-banner-card sectionTitle="応援プロジェクト" :props="$cheer_projects" />
    <x-user.project-banner-card sectionTitle="最新の応援プロジェクト" :props="$new_projects" />
    <x-user.project-banner-card sectionTitle="人気の応援プロジェクト" :props="$popularity_projects" />
    <x-user.project-banner-card sectionTitle="募集終了が近い応援プロジェクト" :props="$nearly_deadline_projects" />
    <x-user.project-banner-card sectionTitle="もうすぐ公開の応援プロジェクト" :props="$nearly_open_projects" />
</div>
@endsection
