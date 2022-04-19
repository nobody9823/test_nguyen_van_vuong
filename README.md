# laravel_jarvis

## Introduction

Build jarvis from laravel with docker-compose

## Usage

laravel_jarvis では Docker の立ち上げ、コマンド実行、Laravel プロジェクトの作成などの多くの操作を C 言語等の煩雑なビルド作業をまとめて 1 つのコマンドで実行できるようにするのに広く使われている make で実行できるように[Makefile](https://github.com/valleyin-dev/laravel_jarvis/blob/main/Makefile)を用意しています。

公式サイト( https://www.gnu.org/software/make/ )から make コマンドを実行する環境をインストールして使用すると楽になるかもしれません。

このリポジトリでは既に Laravel のプロジェクトは作成されてしまっているので必要なライブラリ等だけ composer の install でインストールすれば大丈夫なはずです。

make コマンドがインストールされている場合は以下のコマンドを実行して頂ければ、現在リポジトリに作成されているプロジェクトが localhost で立ち上がるまで完了すると思います。

```bash
$ make init
```

http://localhost

また初めに、既存のマイグレーションファイルを実行するために

```bash
make refresh
```

を実行してください。既にプロジェクトの方で作成されているテーブル構造にローカルのデータベースを統一することができます。

## Tips

Read this Wiki(hove not implemented). <!-- [Wiki](). -->

## Container structure

```bash
├── app
├── web
└── db
```

### app container

- Base image
  - [php](https://hub.docker.com/_/php):7.4-fpm-buster
  - [composer](https://hub.docker.com/_/composer):2.0

### web container

- Base image
  - [nginx](https://hub.docker.com/_/nginx):1.18-alpine
  - [node](https://hub.docker.com/_/node):14.2-alpine

### db container

- Base image
  - [mysql](https://hub.docker.com/_/mysql):8.0

#### Persistent MySQL Storage

By default, the [named volume](https://docs.docker.com/compose/compose-file/#volumes) is mounted, so MySQL data remains even if the container is destroyed.
If you want to delete MySQL data intentionally, execute the following command.

```bash
$ docker-compose down -v && docker-compose up
```

### コミュニケーション

- Slack にファンリターンのワークスペースがあり、質問共有チャンネルでバグ報告や開発においての質問などをする。
- 通知専用チャンネルは本番環境のサーバーエラー通知と GitHub の通知などが送られる。

### ClickUp

Using ClickUp to manage project
See more detail at valleyin wiki

## 開発に使用するもの

- ER 図<br>
こちらにテーブルの説明やカラムの内容等を記載しています。ER 図の変更があれば下記の、更新方法を参考に更新してください。<br>
https://ondras.zarovi.cz/sql/demo/?keyword=fanreturn
<details>
<summary>更新方法</summary>

1. 画面右上の「SAVE / LOAD」をクリック<br>
   <img width="192" src="https://user-images.githubusercontent.com/66456130/160050433-f5d515a7-7fc0-40ac-8fe8-556c41cb59ac.png"><br>
2. 下記画像の「SAVE」ボタンをクリック<br>
   <img width="387" src="https://user-images.githubusercontent.com/66456130/160050437-83e56341-eb5d-4456-9932-ff4bc6bbfc81.png"><br>
3. 「OK」ボタンをクリック<br>
<img width="445" src="https://user-images.githubusercontent.com/66456130/160050439-a207ff5c-4c9e-472f-a803-a518d789f260.png">
</details>

- メール<br>
  ローカル環境でメールの動作を確認する際はこちらの URL で MailLog にアクセスしてください。<br>
  http://localhost:8025

- クレジットカードのテスト番号<br>
  https://resource-sharing.co.jp/ec-sites-credit-card-test-number/

- GMO PAYMENT の決済と送金サービスの仕様書（実装の際に参照ください）<br>
<details>
<summary>各種仕様書</summary>

【決済サービス】<br>
決済機能の実装や修正の際に参照ください。OrderID、ShopID、JobCd 等のパラメータの説明も記載されています。<br>
クレジットカード決済とコンビニ決済では仕様が違うため、内容を参照してください。<br>

- クレジットカード
  [800\_クレジットカード決済利用マニュアル\_1.17.pdf](https://github.com/valleyin-dev/fan-return-laravel/files/8347530/800_._1.17.pdf)<br>
- コンビニ支払い
  [プロトコルタイプ(マルチ決済インタフェース仕様)\_2_01.pdf](https://github.com/valleyin-dev/fan-return-laravel/files/8511553/_2_01.pdf)<br>

【送金サービス】<br>
銀行口座登録や送金処理の実装や修正の際に参照ください。Deposit_ID、Bank_ID、その他銀行のパラメータの説明も記載されています。<br>
[【GMO-PG 送金サービス】(A2)API 仕様書-銀行振込編\_20210824.pdf](https://github.com/valleyin-dev/fan-return-laravel/files/8347529/GMO-PG.A2.API.-._20210824.pdf)<br>

【トークン仕様書】<br>
gmo-create-card-token.js ファイルの決済に使用するトークン生成処理を修正する際に参照ください。<br>
[トークン決済サービス仕様書\_1_33.pdf](https://github.com/valleyin-dev/fan-return-laravel/files/8347531/_1_33.pdf)<br>

【メール送金】<br>
コンビニ決済の場合で返金する必要がある場合にメール送金サービスを使って返金を行います。そのシステムの詳細になります。<br>
メール送金の仕様については　 5(A1)メール送金指示　からになります。
[(A1)API 仕様書-共通編\_20211028.pdf](https://github.com/valleyin-dev/fan-return-laravel/files/8511591/GMO-PG.A1.API.-._20211028.pdf)<br>

</details>

## 仕様

仕様については以下のリンクをクリックしてください。<br>
https://github.com/valleyin-dev/fan-return-laravel/blob/develop/SPECIFICATION.md
