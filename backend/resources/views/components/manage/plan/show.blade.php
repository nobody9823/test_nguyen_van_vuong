@extends($role.'.layouts.base')

@section('title', 'プラン詳細')

@section('content')
<header class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        プラン詳細
    </div>
    <div class="text-right">
        <a href="{{ route($role.'.plan.index') }}" class="btn btn-outline-info">プラン一覧へ戻る</a>
    </div>
</header>

<article class="card mt-3">
    <header class="d-flex justify-content-between card-header">
        <h5>
            プラン詳細
        </h5>
        <div>
            <a href="{{ route($role.'.plan.preview', ['project' => $plan->project, 'plan' => $plan]) }}"
                class="btn btn-success">プレビュー</a>
            @if($plan->project !== null && (($plan->project->release_status !== '掲載中' && $plan->project->release_status !== '承認待ち') || $role === "admin"))
            <a href="{{ route($role.'.plan.edit', ['project' => $plan->project, 'plan' => $plan]) }}"
                class="btn btn-primary">編集</a>
            <div style="display: inline-flex">
                <form action="{{ route($role.'.plan.destroy', ['project' => $plan->project, 'plan' => $plan]) }}"
                        method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-dell" type="submit">削除</button>
                </form>
            </div>
            @endif
        </div>
    </header>

    <section class="container">
        <div class="row p-0">
            <img src="{{ asset(Storage::url($plan->image_url)) }}" class="col-sm-4 p-3" style="object-fit: contain;">
            <section class="card-body col-sm-8">
                <div class="container">
                    <div class="row">
                        <div class="col" style="font-size: 24px">
                            {{ $plan->title }}
                        </div>
                    </div>
                    <div class="row pt-3" style="font-size: 20px">
                        <div class="col-sm-3">
                            価格
                        </div>
                        <div class="col-sm-9">
                            {{ $plan->price }}円
                        </div>
                    </div>
                    <div class="row row-col-2 pt-3" style="font-size: 20px">
                        <div class="col-sm-3">
                            プラン内容
                        </div>
                        <div class="col-sm-9" style="overflow-wrap: break-word;">
                            {{ $plan->content }}
                        </div>
                    </div>
                    <div class="row row-col-2 pt-3" style="font-size: 20px">
                        <div class="col-sm-3">
                            個数
                        </div>
                        <div class="col-sm-9" style="overflow-wrap: break-word;">
                            {{ $plan->limit_of_supporters ?: "個数設定なし" }}</p>
                        </div>
                    </div>
                    <div class="row row-col-2 pt-3" style="font-size: 20px">
                        <div class="col-sm-3">
                            お返し予定日
                        </div>
                        <div class="col-sm-3">
                            {{ $plan->delivery_date }}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</article>
@endsection

@section('script')
<script>
    $(function(){
        $(".btn-dell").click(function(){
            if(confirm("本当に削除しますか？")){
            }else {
                return false;
            }
        });
    });
</script>
@endsection
