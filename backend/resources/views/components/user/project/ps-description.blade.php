<div class="ps_description_wrapper">
    <div class="ps_description_title">
        <p>①リターン購入後、招待リンクを発行</p>
        <span>あなた専用の招待リンク(URL)が発行されます。</span>
    </div>
    <div class="ps_description_items_wrapper">
        <div class="ps_description_item">
            <div class="ps_desc_img"><img src="{{ asset('image/fan_psd_L_01.svg') }}"></div>
        </div>
        <div class="ps_description_border"></div>
        <div class="ps_description_item">
            <div class="av_sns_btn dis_f_wra_alc">
                <a>
                    <img src="{{ asset('image/sns_01.svg') }}">
                </a>
                <a>
                    <img src="{{ asset('image/sns_02.svg') }}">
                </a>
                <a>
                    <img src="{{ asset('image/sns_03.svg') }}">
                </a>
            </div>
            <div class="def_btn arrow_top_right">
                招待リンクをコピーする
                <a class="cover_link"></a>
            </div>
            <div class="def_btn">
                ランキングを見る
                <a class="cover_link"></a>
            </div>
        </div>
    </div>

    <div class="ps_desc_img ps_desc_img_a"><img src="{{asset('image/fan_psd_arrow.svg')}}"></div>

    <div class="ps_description_title">
        <p>②招待リンクをSNSなどで宣伝</p>
        <span>招待リンク(URL)をSNSなどに貼って投稿。</span>
    </div>
    <div class="ps_description_items_wrapper">
        <div class="ps_description_item">
            <div class="ps_desc_img"><img src="{{asset('image/fan_psd_L_02.svg')}}"></div>
        </div>
        <div class="ps_description_border"></div>
        <div class="ps_description_item">
            <div class="ps_description_posts_example_wrapper">
                <div class="posts_example_times">
                    <i class="fas fa-times"></i>
                </div>
                <div class="posts_example_content">
                    <div class="posts_example_user_icon">
                        <i class="far fa-user-circle"></i>
                    </div>
                    <div class="posts_example_text">
                        <p>私が応援しているプロジェクトです！応援お願いします！</p>
                        <p>#fanReturn #ファンリターン</p>
                        <p>
                            Https://fanreturn.work/project/〇〇?
                            <br/>
                            inviter=abcdefghijklmnopqrstuvwxyzab
                            <br/>
                            cdefghijklmnopqrstuvwxyzabcdefghijkl
                            <br/>
                            mnopqrstuvwxyzabcdefghijklmnopqrstuv
                            <br/>
                            wxyz==
                        </p>
                        <p>全員に返信ができます</p>
                    </div>
                </div>
                <div class="posts_example_footer">
                    <div>
                        <i class="far fa-image"></i>
                        <i class="far fa-file-video"></i>
                        <i class="fas fa-chart-bar"></i>
                        <i class="far fa-smile"></i>
                        <i class="far fa-clock"></i>
                    </div>
                    <div class="posts_example_btn">
                        <p>
                            ツイートする
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ps_desc_img ps_desc_img_a"><img src="{{asset('image/fan_psd_arrow.svg')}}"></div>

    <div class="ps_description_title">
        <p>③ランキング</p>
        {{-- NOTICE: 支援総額が戻ったらこちらのコメントアウトを外す --}}
        <span>あなた専用の招待リンクから購入した支援者の、{{--紹介支援総額と--}}紹介支援人数が表示されます。</span>
    </div>
    {{-- <p class="ps_description_text">紹介支援総額とは、あなた専用の招待リンクから支援者が購入した総額です。</p> --}}
    <p class="ps_description_text">紹介支援人数とは、あなた専用の招待リンクから購入した支援者の人数です。</p>
    <div class="ps_description_items_wrapper">

        <div class="ps_description_item">

            <div class="ps_desc_img"><img src="{{asset('image/fan_psd_L_03.svg')}}"></div>

        </div>
        <div class="ps_description_border"></div>
        <div class="ps_description_item">

            <div class="ps_description_ranking_wrapper" style="justify-content: center;"><!-- FIXME: こちらのスタイルも支援総額が戻ったら削除 -->
                {{-- <div class="ps_ranking_example_wrapper">
                    <div class="ps_rank_02_tit">支援総額</div>

                    <div class="ps_rank_02_rank_item_row">
                        <div class="ps_ranking_example_01">
                            <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                            <path id="" class="rank_color_01" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                            </svg>
                        </div>
                        <div class="ps_ranking_example_02">1位</div>
                        <div class="ps_ranking_example_03">********</div>
                        <div class="ps_ranking_example_04">52,300円</div>
                    </div><!--/ps_rank_02_rank_item_row-->

                    <div class="ps_rank_02_rank_item_row">
                        <div class="ps_ranking_example_01">
                            <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                            <path id="" class="rank_color_02" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                            </svg>
                        </div>
                        <div class="ps_ranking_example_02">2位</div>
                        <div class="ps_ranking_example_03">********</div>
                        <div class="ps_ranking_example_04">35,000円</div>
                    </div><!--/ps_rank_02_rank_item_row-->

                    <div class="ps_rank_02_rank_item_row">
                        <div class="ps_ranking_example_01">
                            <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                            <path id="" class="rank_color_03" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                            </svg>
                        </div>
                        <div class="ps_ranking_example_02">3位</div>
                        <div class="ps_ranking_example_03">********</div>
                        <div class="ps_ranking_example_04">35,000円</div>
                    </div><!--/ps_rank_02_rank_item_row-->

                </div><!--/ps_rank_02_L-->

                <div class="ps_ranking_example_right_border"></div> --}}

                <div class="ps_ranking_example_wrapper" style="width: 70%;"><!-- FIXME: こちらのスタイルも支援総額が戻ったら削除 -->

                    <div class="ps_rank_02_tit">紹介人数</div>

                    <div class="ps_rank_02_rank_item_row">
                        <div class="ps_ranking_example_01">
                            <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                            <path id="" class="rank_color_01" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                            </svg>
                        </div>
                        <div class="ps_ranking_example_02">1位</div>
                        <div class="ps_ranking_example_03">********</div>
                        <div class="ps_ranking_example_04">3240人</div>
                    </div><!--/ps_rank_02_rank_item_row-->

                    <div class="ps_rank_02_rank_item_row">
                        <div class="ps_ranking_example_01">
                            <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                            <path id="" class="rank_color_02" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                            </svg>
                        </div>
                        <div class="ps_ranking_example_02">2位</div>
                        <div class="ps_ranking_example_03">********</div>
                        <div class="ps_ranking_example_04">540人</div>
                    </div><!--/ps_rank_02_rank_item_row-->

                    <div class="ps_rank_02_rank_item_row">
                        <div class="ps_ranking_example_01">
                            <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                            <path id="" class="rank_color_03" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                            </svg>
                        </div>
                        <div class="ps_ranking_example_02">3位</div>
                        <div class="ps_ranking_example_03">********</div>
                        <div class="ps_ranking_example_04">540人</div>
                    </div><!--/ps_rank_02_rank_item_row-->

                </div>
            </div>

        </div>

    </div>

    <div class="ps_desc_img ps_desc_img_a"><img src="{{asset('image/fan_psd_arrow.svg')}}"></div>

    <div class="ps_description_title">
        <p>
            ④インフルエンサーが用意した条件に応じて、
            <br/>
            特別なプロジェクトサポーター(PS)リターンを受け取ることができます。
        </p>
    </div>
    <p class="ps_description_text">（例）<!-- 紹介支援総額上位３名と、-->紹介支援人数上位３名限定で、お礼イベント開催。</p>{{-- FIXME: こちらも支援総額が戻ったら外す --}}
    <div class="ps_description_items_wrapper">

        <div class="" style="width: 70%;">

            <div class="ps_desc_img"><img src="{{asset('image/fan_psd_L_04.svg')}}"></div>

        </div>

    </div>
</div>
