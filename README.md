# laravel_jarvis

## Introduction

Build jarvis from laravel with docker-compose


## Usage
laravel_jarvisではDockerの立ち上げ、コマンド実行、Laravelプロジェクトの作成などの多くの操作をC言語等の煩雑なビルド作業をまとめて1つのコマンドで実行できるようにするのに広く使われているmakeで実行できるように[Makefile](https://github.com/valleyin-dev/laravel_jarvis/blob/main/Makefile)を用意しています。


公式サイト( https://www.gnu.org/software/make/ )からmakeコマンドを実行する環境をインストールして使用すると楽になるかもしれません。

このリポジトリでは既にLaravelのプロジェクトは作成されてしまっているので必要なライブラリ等だけcomposerのinstallでインストールすれば大丈夫なはずです。

makeコマンドがインストールされている場合は以下のコマンドを実行して頂ければ、現在リポジトリに作成されているプロジェクトがlocalhostで立ち上がるまで完了すると思います。
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

### ClickUp
Using ClickUp to manage project
See more detail at valleyin wiki

