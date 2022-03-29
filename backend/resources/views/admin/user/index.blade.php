@extends('admin.layouts.base')

@section('title', 'ユーザー管理')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        ユーザー管理
        <x-manage.display_index_count :props="$users" />
    </div>
    <form action="{{ route('admin.user.index') }}" class="form-inline pr-3" method="get">
        <x-manage.sort_form :props_array="[
            'name' => '名前',
            'email' => 'email',
        ]" />
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    <div class="text-right">
        <a href="{{ route('admin.user.create') }}" class="btn btn-outline-success">新規作成</a>
    </div>
</div>
<x-manage.search-terms role="admin" model='user' />
<div class="card-body">
    @if(count($users) <= 0) <p>ユーザーデータがありません。</p>
        @else
        <table class="table">
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th style="width:12%">プロフィール詳細<br>表示/編集</th>
                <th style="width:12%">住所<br>表示/編集</th>
                <th style="width:12%">基本情報<br>編集/削除 </th>
            </tr>
             @foreach($users as $user)
             <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->address as $prof)
                    <button class="btn btn-secondary" type="button" data-toggle="collapse"
                        data-target="#collapseUserProfile{{ $user->id }}_{{ $prof->id }}" aria-expanded="true"
                        aria-controls="collapseUserProfile">
                        詳細 ▼
                    </button>
                    <div class="collapse {{ $loop->index === 0?'show':null }}" id="collapseUserProfile{{$user->id}}_{{ $prof->id }}">
                        <div class="card" style="border: none; background-color: #f8f9fa;">
                            <button type="button" class="btn btn-sm btn-success mt-1" data-toggle="modal"
                                data-target="#user_profile{{ $user->id }}_{{ $prof->id }}">
                                表示
                            </button>
                            <a href="{{ route('admin.profile.edit', ['user' => $user,'profile' => $user->profile, 'address_id' => $prof->id ]) }}"
                                class="btn btn-sm btn-primary mt-1">編集</a>
                        </div>
                    </div>
                    <div class="modal fade" id="user_profile{{ $user->id }}_{{ $prof->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="user_profile_modal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="user_profile_modal">{{ $user->name }}様のプロフィール情報</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>StripeのアカウントID: {{ optional($user->identification)->connected_account_id }}</p>
                                    <p>招待者コード:{{ optional($user->profile)->inviter_code }}</p>
                                    <p>姓:{{ optional($prof)->last_name }}</p>
                                    <p>名:{{ optional($prof)->first_name }}</p>
                                    <p>姓(カナ):{{ optional($prof)->last_name_kana }}</p>
                                    <p>名(カナ):{{ optional($prof)->first_name_kana }}</p>
                                    <p>出身地:{{ optional($user->profile)->birth_place }}</p>
                                    <p>生年月日:{{ optional($user->profile)->birthday }}</p>
                                    <p>公開状態:{{ optional($user->profile)->birthday_is_published ?'公開中':'非公開中' }}</p>
                                    <p>性別:{{ optional($user->profile)->gender }}</p>
                                    <p>公開状態:{{ optional($user->profile)->gender_is_published ?'公開中':'非公開中' }}</p>
                                    <p>紹介文:{{ optional($user->profile)->introduction }}</p>
                                    <p>画像:
                                        <img style="max-height:5vw;"
                                            src="{{ asset(Storage::url(optional($user->profile)->image_url)) }}">
                                    </p>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </td>
                <td>
                    @foreach($user->address as $addrs)
                    <button class="btn btn-secondary" type="button" data-toggle="collapse"
                        data-target="#collapseAddress{{ $user->id }}_{{ $addrs->id }}" aria-expanded="true"
                        aria-controls="collapseAddress">
                        住所 ▼
                    </button>
                    <div class="collapse {{ $loop->index === 0?'show':null }}" id="collapseAddress{{$user->id}}_{{ $addrs->id }}">
                        <div class="card" style="border: none; background-color: #f8f9fa;">
                            <button type="button" class="btn btn-sm btn-success mt-1" data-toggle="modal"
                                data-target="#user_address{{ $user->id }}_{{ $addrs->id }}">
                                表示
                            </button>
                            <a href="{{ route('admin.address.edit', ['user' => $user, 'address_id' => $addrs->id ]) }}"
                                class="btn btn-sm btn-primary mt-1">編集</a>
                        </div>
                    </div>
                    <div class="modal fade" id="user_address{{ $user->id }}_{{ $addrs->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="user_address_modal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="user_address_modal">{{ $user->name }}様の住所情報</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>郵便番号:{{ optional($addrs)->postal_code }}</p>
                                    <p>都道府県:{{ optional($addrs)->prefecture }}</p>
                                    <p>住所1(市町村など):{{ optional($addrs)->city }}</p>
                                    <p>住所2(番地など):{{ optional($addrs)->block }}</p>
                                    <p>住所3(建物番号など):{{ optional($addrs)->building }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </td>
                <td>
                    @foreach($user->address as $delUsr)
                    <button class="btn btn-secondary" type="button" data-toggle="collapse"
                        data-target="#collapseExample{{ $user->id }}_{{ $delUsr->id }}" aria-expanded="true"
                        aria-controls="collapseExample">
                        設定 ▼
                    </button>
                    <div class="collapse {{ $loop->index === 0?'show':null }}" id="collapseExample{{$user->id}}_{{ $delUsr->id }}">
                        <div class="card" style="border: none; background-color: #f8f9fa;">
                            <a href="{{ route('admin.user.edit', ['user' => $user]) }}_{{ $delUsr->id }}"
                                class="btn btn-sm btn-primary mt-1">編集</a>
                            <form action="{{ route('admin.user.destroy', ['user' => $user, 'address_id' => $delUsr->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger mt-1 w-100 btn-dell" type="submit">削除</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center text-cneter">
            {{ $users->appends(request()->input())->links() }}
        </div>
        @endif
</div>
@section('script')
<script>
    $(function(){
    $(".btn-dell").click(function(){
    if(confirm("本当に削除しますか？")){
    //そのままsubmit（削除）
    }else{
    //cancel
    return false;
    }
    });
    });
</script>
@endsection

@endsection
