{{--
    PSリターンをトグルで表示するコンポーネント
    display: flex; flex-wrap: wrap; justify-content:space-between;
    の中にある想定なので注意
    --}}
@isset($project)
    {{-- <div class="ps_rank_02_return_L">
        <div class="ps_rank_02_return_tit return_opener">リターン内容(紹介支援総額)</div>
        <!--/ps_rank_01-->
        <div class="ps_rank_return_text return_content">
            {!! $project->reward_by_total_amount !!}
        </div>
    </div> --}}

    <div class="ps_rank_02_return_R">
        <div class="ps_rank_02_return_tit return_opener">リターン内容(紹介人数)</div>
        <!--/ps_rank_01-->
        <div class="ps_rank_return_text return_content">
            {!! $project->reward_by_total_quantity !!}
        </div>
    </div>

    <script>
        jQuery(function ($) {
            //質問をクリック
            $(".return_opener").click(function () {
                $(this).toggleClass("return_open");
                //thisにopenクラスを付与
                $(this).next().slideToggle(300);
                //thisのcontentを展開、開いていれば閉じる
            });
        });
    </script>
    <style>
        .return_opener{
        position: relative;
        cursor: pointer;
        }
        .return_opener:after {
        content: "";
        position: absolute;
        right: 25px;
        top: 38%;
        transition: all 0.5s ease-in-out;
        /*   要素の動きを指定 */

        display: block;
        width: 8px;
        height: 8px;
        border-top: solid 4px #00AEBD;
        border-right: solid 4px #00AEBD;

        -webkit-transform: rotate(135deg);
        transform: rotate(135deg);
        /* transform: rotateで要素の角度を指定 */

        }

        .return_opener.return_open:after {
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        top: 45%;
        /*   .openクラスがついた時の要素の角度を指定 */
        }
    </style>
@else
    {{-- <div class="ps_rank_02_return_L">
        <div class="ps_rank_02_return_tit return_opener">リターン内容(紹介支援総額)</div>
        <!--/ps_rank_01-->
        <div class="ps_rank_return_text return_content">
            <p>上位３名の方に特別お礼イベント開催！</p>
            <img class="" src="{{Storage::url('public/sampleImage/now_printing.png')}}">
            <br/>
        </div>
    </div> --}}

    <div class="ps_rank_02_return_R">
        <div class="ps_rank_02_return_tit return_opener">リターン内容(紹介人数)</div>
        <!--/ps_rank_01-->
        <div class="ps_rank_return_text return_content">
            <p>上位３名の方に特別お礼イベント開催！</p>
            <img class="" src="{{Storage::url('public/sampleImage/now_printing.png')}}">
            <br/>
        </div>
    </div>
@endisset
