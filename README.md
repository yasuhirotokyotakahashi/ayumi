# coachtechフリマ

## 目的
coachtechフリマは、coachtechブランドのアイテムを出品する、独自のフリマアプリです。10~30代の社会人がターゲットユーザーであり、初年度でのユーザー数1000人達成が目標です。

## アプリケーションURL
- http://52.69.179.9/

## 他のリポジトリ
- [本プロジェクトのリポジトリ](https://github.com/yasuhirotokyotakahashi/ayumi)

## 機能一覧
- 新規ユーザー登録
- ログイン機能
- ログアウト機能
- 商品一覧取得機能
- 商品詳細取得機能
- ユーザー商品お気に入り一覧取得機能
- ユーザー情報取得機能
- ユーザー購入商品一覧取得機能
- ユーザー出品商品一覧取得機能
- プロフィール変更機能
- 商品お気に入り追加機能
- 商品お気に入り削除機能
- 商品コメント追加機能
- 商品コメント削除機能
- 出品機能
- 購入機能
- 配送先変更機能

## 使用技術（実行環境）
- フレームワーク：Laravel [Laravelバージョン:10.10]
- PHP：[PHPバージョン: 8.3.6]
- Node：[Nodeバージョン: 20.12.2]
- Vue:[Vueバージョン:3.4.0]
- Vite:[Viteバージョン:5.2.8]
- Inertia:[Inertiaバージョン:0.6.8]
- Tailwind CSS:[Tailwind CSSバージョン:3.2.1]
- データベース：MySQL [MySQLバージョン:8.0.26 for Linux on x86_64 (MySQL Community Server - GPL)]


## テーブル設計
以下は、主要なデータベーステーブルとそのフィールドの概要です。

**usersテーブル**
- id (主キー)
- name
- email
- password
- created_at
- updated_at

| カラム     |         |
|------------|---------|
| id         | PK      |
| name       |         |
| email      |         |
| password   |         |
| created_at |         |
| updated_at |         |

**profilesテーブル**
- id (主キー)
- user_id (外部キー、usersテーブルと関連)
- name
- img_url
- postcode
- address
- building
- created_at
- updated_at

**itemsテーブル**
- id (主キー)
- name
- price
- description
- img_url
- user_id (外部キー、usersテーブルと関連)
- category_id(外部キー、categoriesテーブルと関連)
- condition_id(外部キー、conditionsテーブルと関連)
- created_at
- updated_at

**likesテーブル**
- id (主キー)
- user_id (外部キー、usersテーブルと関連)
- item_id(外部キー、itemsテーブルと関連)
- created_at
- updated_at

**commentsテーブル**
- id (主キー)
- user_id (外部キー、usersテーブルと関連)
- item_id(外部キー、itemsテーブルと関連)
- comment
- created_at
- updated_at

**conditionsテーブル**
- id (主キー)
- condition
- created_at
- updated_at

**sold_itemテーブル**
- id (主キー)
- user_id (外部キー、usersテーブルと関連)
- item_id(外部キー、itemsテーブルと関連)
- created_at
- updated_at

**category_itemテーブル**
- id (主キー)
- item_id (外部キー、usersテーブルと関連)
- category_id(外部キー、categoriesテーブルと関連)
- created_at
- updated_at

**rolesテーブル**
- id (主キー)
- user_id (外部キー、usersテーブルと関連)
- item_id(外部キー、itemsテーブルと関連)
- created_at
- updated_at

**permissionsテーブル**
- id (主キー)
- user_id (外部キー、usersテーブルと関連)
- item_id(外部キー、itemsテーブルと関連)
- created_at
- updated_at

**role_has_permissionsテーブル**
- id (主キー)
- user_id (外部キー、usersテーブルと関連)
- item_id(外部キー、itemsテーブルと関連)
- created_at
- updated_at

**model_has_rolesテーブル**
- id (主キー)
- user_id (外部キー、usersテーブルと関連)
- item_id(外部キー、itemsテーブルと関連)
- created_at
- updated_at

**model_has_permissionsテーブル**
- id (主キー)
- user_id (外部キー、usersテーブルと関連)
- item_id(外部キー、itemsテーブルと関連)
- created_at
- updated_at




## ER図
![testdayo](https://github.com/yasuhirotokyotakahashi/ayumi/assets/128282431/347aa656-6efe-4451-8045-1e68ab30fd80)

## 環境構築
プロジェクトをローカルで実行するための手順を以下に示します。docker及びdocker-composeは導入済みとします。


```bash
mkdir my-project
cd my-project
```
my-projectの箇所はお好きなディレクトリ名で作成してください。
```bash
git clone　https://github.com/yasuhirotokyotakahashi/ayumi.git
sudo chmod -R 777 *
cd ayumi
```
ここからdockerのビルドから最後まで一気に行います。
```bash
docker compose build
docker compose up -d
docker compose exec php bash

composer install
npm install --save-dev vite laravel-vite-plugin @vitejs/plugin-vue

php artisan key:generate
php artisan migrate
php artisan db:seed

npm run build

```

##　無事localhostでアクセスできると思います。
必要に応じて、管理者、店舗代表者、認証ユーザーという役割を作成したのでphp artisan db:seed PermissionsSeederやphp artisan storage:linkなどもご使用ください。