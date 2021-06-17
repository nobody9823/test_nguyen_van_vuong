<?php

namespace App\Helpers;

class DisplayVideoHelper {
    /**
     * Display video with youtube url at Manage pages
     *
     * @param string $video_url
     * @return mixed
     */
    public static function getVideoAtManage($video_url)
    {
        $parse_url = self::getParseUrl($video_url);

        $video_id = self::getVideoId($parse_url);

        $v_param = self::getParams($parse_url);

        if ($video_id!== false){
            // 埋め込みコードを返す
            echo '<div class="embed-responsive embed-responsive-1by1"><iframe width="600" height="338" src="https://www.youtube.com/embed/' . $video_id . $v_param . '" frameborder="0" class="pt-4" allowfullscreen></iframe></div>';
        }
        // パラメータが不正(youtubeのURLではない)ときは埋め込みコードを生成しない。
        return false;
    }

    /**
     * Display video with youtube url at User pages
     *
     * @param string $video_url
     * @return mixed
     */
    public static function getVideoAtUser($video_url)
    {
        $parse_url = self::getParseUrl($video_url);

        $video_id = self::getVideoId($parse_url);

        $v_param = self::getParams($parse_url);

        if ($video_id!== false){
            // 埋め込みコードを返す
            echo '<div style="position:relative; width:100%; height:0; padding-top:25%;"><iframe width="600" height="338" src="https://www.youtube.com/embed/' . $video_id . $v_param . '" frameborder="0" class="pt-4" allowfullscreen style="position:absolute; top:0; left:0; width:100%; height:100%;"></iframe></div>';
        }
        // パラメータが不正(youtubeのURLではない)ときは埋め込みコードを生成しない。
        return false;
    }

    /**
     * Display thumbnail with youtube url
     *
     * @param string $video_url
     * @return mixed
     */
    public static function getThumbnail($video_url)
    {
        $parse_url = self::getParseUrl($video_url);

        $video_id = self::getVideoId($parse_url);

        if($video_id !== false){
            echo '<img src="https://img.youtube.com/vi/'.$video_id.'/default.jpg" />';
        }
        // パラメータが不正(youtubeのURLではない)ときは埋め込みコードを生成しない。
        return false;
    }

    /**
     * Get parse url of you tube
     *
     * @param string $video_url
     * @return mixed
     */
    private static function getParseUrl($video_url)
    {
        //とりあえずURLがyoutubeのURLであるかをチェック
        if(preg_match('#https?://www.youtube.com/.*#i',$video_url,$matches)){
            //parse_urlでhttps://www.youtube.com/watch以下のパラメータを取得
            return parse_url($video_url);
        } else {
            return false;
        }
    }

    /**
     * Get video Id with parse url
     *
     * @param string $video_url
     * @return mixed
     */
    private static function getVideoId($parse_url)
    {
        if ($parse_url !== false && preg_match('#v=([-\w]{11})#i', $parse_url['query'], $v_matches)) {
            return $v_matches[1];
        } else {
            // 万が一動画のIDの存在しないURLだった場合は埋め込みコードを生成しない。
            return false;
        }
    }

    /**
     * Get params of you tube url
     *
     * @param string $video_url
     * @return mixed
     */
    private static function getParams($parse_url)
    {
        $v_param = '';
        if ($parse_url !== false ){
            // パラメータにt=XXmXXsがあった時の埋め込みコード用パラメータ設定
            // t=〜〜の部分を抽出する正規表現は記述を誤るとlist=〜〜の部分を抽出してしまうので注意
            if (preg_match('#t=([0-9ms]+)#i', $parse_url['query'], $t_maches)) {
                $time = 0;
                if (preg_match('#(\d+)m#i', $t_maches[1], $minute)) {
                    // iframeでは正の整数のみ有効なのでt=XXmXXsとなっている場合は整形する必要がある。
                    $time = $minute[1]*60;
                }
                if (preg_match('#(\d+)s#i', $t_maches[1], $second)) {
                    $time = $time+$second[1];
                }
                if (!preg_match('#(\d+)m#i', $t_maches[1]) && !preg_match('#(\d+)s#i', $t_maches[1])) {
                    // t=(整数)の場合はそのままの値をセット ※秒数になる
                    $time = $t_maches[1];
                }
                $v_param .= '?start=' . $time;
            }
            // パラメータにlist=XXXXがあった時の埋め込みコード用パラメータ設定
            if (preg_match('#list=([-\w]+)#i', $parse_url['query'], $l_maches)) {
                if (!empty($v_param)) {
                    // $v_paramが既にセットされていたらそれに続ける
                    $v_param .= '&list=' . $l_maches[1];
                } else {
                    // $v_paramが既にセットされていなかったら先頭のパラメータとしてセット
                    $v_param .= '?list=' . $l_maches[1];
                }
            }
        }
            return $v_param;
        }
}