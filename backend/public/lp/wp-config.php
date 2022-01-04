<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'valleyin_fanreturn' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'valleyin_jarvis' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'kbQXQCi.7BxiC2L' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'mysql8028.xserver.jp' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'nW`0!?ymw=G}Sq_)H<3`lDjoM_[C.0Ad,d%. .l82xUo7~Qc];uz^IAp 6D,rdSP' );
define( 'SECURE_AUTH_KEY',  '}F=9bW=,Ud/@([T=E`<76dfU]CB[}.HRl.<N_&G-}C@KCUo;2 59ME-i%/D_+]ha' );
define( 'LOGGED_IN_KEY',    ':mMy@1VW$s{d]ICu61+`OT4F2F}ZhFh?KC|A-z$it;[Ho)]qFJR|v{$~x`s#+PR{' );
define( 'NONCE_KEY',        '1@:D|8c ^,<4h-31K{{/@YM>(DS3nw)2%U|]%j$$#F{W1LXouvD891f%PuMqb51X' );
define( 'AUTH_SALT',        'LnioXZ:X}ITVHrK-dA8,~]^F,w2#p0/EZ_pkK~QNRm`(fhz}cky=ikSyJquvc/&?' );
define( 'SECURE_AUTH_SALT', ')C!Yni;Rq ,xTd@(jo=L)a5,eP#hcrH6C1 20xO=M3+Zb$C*B;_c/Av(.!A{uR5k' );
define( 'LOGGED_IN_SALT',   'h8tw=jq!yw/@:|+nkg_TFU|liAUtv)Q7,_$/]h^7)H,Or3m}+k,*D/mrqfc2l*/h' );
define( 'NONCE_SALT',       '~V$MNWwd#@*&wV0 USe3E!xN~;twWIdZ7V*p;[.ydeomrV_iG9j7JyF{!l};&it,' );
define( 'WP_CACHE_KEY_SALT','=#l^<dU3} YRWYWR%[Qo+7``7A~8v41Me;hj[~Q~xF:Aqhr/FUP+0as;2^F&3z#@' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* カスタム値は、この行と「編集が必要なのはここまでです」の行の間に追加してください。 */



/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
