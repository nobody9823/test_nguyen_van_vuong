<div class="content sub_content detail_content">
    <div class="fixedcontainer">
        <div class="breadcrumb">
            <p>
                <a href="/">TOP</a>　＞　<a href="/search">応援プロジェクト</a>　＞　
                @if($project->category)
                <a href="{{ route('user.search', ['category_id' => $project->category_id]) }}">{{ $project->category->name }}<a>
                @else
                no category
                @endif
                        　＞　<a href="{{ route('user.project.show', ['project' => $project]) }}">{{ $project->title }}</a>
                        　＞　{{ $plan->title }}
            </p>
        </div>
        <h2 class="sec-ttl">{{ $plan->title }}</h2>
        <div class="project-user detail-user"><img src="{{ Storage::url($project->talent->image_url) }}">{{ $project->talent->name }}</div>
        <div class="detail_info">
            <div class="detail_imgs">
                <div class="detail-slider-for">
                    @if($plan->image_url == "Public/image/contribution.jpeg")
                    <p class="plan-img"><img src="/image/contribution.jpeg"></p>
                    @else
                    <div><img src="{{ Storage::url($plan->image_url) }}"></div>
                    @endif
                </div>
            </div>
            <div class="detail_info_content detail_info_content_mb">
                <p>価格</p>
                <div><span>{{ $plan->price }}</span>円</div>
                <p>目標金額 {{ number_format($project->target_amount) }}円</p>

                <p style="white-space: pre-line;">詳細<br>{{ $plan->content }}</p>
                <p>支援状況</p>
                <div><span>{{ count($plan->users) }}人</span></div>
                @if(!$plan->options->isEmpty())
                    <p>オプション</p>
                    @foreach($plan->options as $option)
                    <div class="option-box">
                        <p>{{ $option->name }}</p>
                        @if(!is_null($option->quantity))
                        <p>残りの数 : {{ $option->quantity }}</p>
                        @endif
                    </div>
                @endforeach
                @endif
                <p>お返しお届け予定日</p>
                <div>
                    {{ $plan->estimated_return_date }}
                </div>
                <p>アイドル</p>
                <div class="project-user detail-user">
                    <img src="{{ Storage::url($project->talent->image_url) }}">
                    {{ $project->talent->name }}
                </div>
                @if($plan->options->every(function($option){ return $option->quantity === 0; }) && !$plan->options->isEmpty())
                <div class="plan-btn-wrap">
                    <a class="plan-btn-end">募集終了</a>
                </div>
                @else
                <div class="plan-btn-wrap"><a class="plan-btn" href="{{ route('user.plan.address', ['project' => $project, 'plan' => $plan]) }}">決済画面へ</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>