@extends('admin.layouts.base')

@section('title', 'キュレーター管理')

@section('content')

<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        キュレーター管理
    </div>
    <form action="" class="form-inline pr-3" method="get">
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    <div class="text-right">
        <a href="{{ route('admin.curator.create') }}" class="btn btn-outline-success">新規作成</a>
    </div>
</div>

    <div class="card-body">
        @if(count($curators) <= 0) <p>ユーザーデータがありません。</p>
            @else
            <table class="table">
                <tr>
                    <th>名前</th>
                    <th>プロジェクト一覧</th>
                    <th style="width:12%">編集/削除</th>
                </tr>
                @foreach($curators as $curator)
                <tr>
                    <td>{{ $curator->name }}</td>
                    <td>
                        <a href="" class="btn btn-success">表示</a>
                    </td>
                    <td>
                        <button class="btn btn-secondary" type="button" data-toggle="collapse"
                            data-target="#collapseExample{{ $curator->id }}" aria-expanded="true"
                            aria-controls="collapseExample">
                            設定 ▼
                        </button>
                        <div class="collapse {{ $loop->index === 0?'show':null }}" id="collapseExample{{$curator->id}}">
                            <div class="card" style="border: none; background-color: #f8f9fa;">
                                <a href="{{ route('admin.curator.edit', ['curator' => $curator]) }}"
                                    class="btn btn-sm btn-primary mt-1">編集</a>
                                <form action="{{ route('admin.curator.destroy', ['curator' => $curator]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mt-1 w-100 btn-dell" type="submit">削除</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="d-flex justify-content-center text-cneter">
                {{ $curators->appends(request()->input())->links() }}
            </div>
            @endif
    </div>
</div>
@endsection
