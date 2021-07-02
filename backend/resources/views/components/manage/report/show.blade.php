@extends($role.'.layouts.base')

@section('title', '活動報告詳細')

@section('content')
<header class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        活動報告詳細
    </div>
    <div class="text-right">
        <a href="{{ route($role.'.report.index') }}" class="btn btn-outline-info">活動報告一覧へ戻る</a>
    </div>
</header>
<article class="card mt-3">
    <header class="d-flex justify-content-between card-header">
        <h5>
            活動報告詳細
        </h5>
        <div>
            <a href="{{ route($role.'.report.edit', ['project' => $report->project, 'report' => $report]) }}"
                class="btn btn-primary">編集</a>
            <div style="display: inline-flex">
                <form action="{{ route($role.'.report.destroy', ['project' => $report->project, 'report' => $report]) }}"
                        method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-dell" type="submit">削除</button>
                </form>
            </div>
        </div>
    </header>

    <section class="container">
        <div class="row p-0">
            <div class="col-sm-4">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <img src="{{ asset(Storage::url($report->image_url)) }}" style="max-width: 100%" class="d-block w-100">
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <section class="card-body col-sm-8">
                <div class="container">
                    <div class="row">
                        <div class="col" style="font-size: 24px">
                            {{ $report->title }}
                        </div>
                    </div>
                    <div class="row row-col-2 pt-3" style="font-size: 20px">
                        <div class="col-sm-3">
                            活動報告内容
                        </div>
                        <div class="col-sm-9" style="overflow-wrap: break-word;">
                            {{ $report->content }}
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