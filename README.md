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

## 追加実装機能
- ブレイクポイント（768px）のスマートフォン用のレスポンシブデザインの実装
- 管理者(admin)と店舗代表者(shop_owner)と利用者(user)の3つの権限の実装
- 管理者用のユーザーの削除が行える管理画面の作成
- 管理者はショップとユーザーのやり取り（コメント）を確認できる
- 店舗代表者はショップスタッフ（userロール）を招待、削除できる
- 招待された利用者のみに許可される商品の出品及び商品へのコメント機能
- 管理画面からの利用者へのメール送信機能
- PHPUnitを使用したテストを実装(/tests/Feature/ItemControllerTest.php)
- 開発環境と本番環境の切り分けの実装(.env.devと.env.prod)
- Circle CIを使ってデプロイとテストの自動化を行う

## 使用技術（実行環境）
- フレームワーク：Laravel [Laravelバージョン:10.10]
- PHP：[PHPバージョン: 8.3.6]
- laravel-permission": "^6.4"
- laravel/breeze": "^1.29"
- Node：[Nodeバージョン: 20.12.2]
- Vue:[Vueバージョン:3.4.0]
- Vite:[Viteバージョン:5.2.8]
- Inertia:[Inertiaバージョン:0.6.8]
- Tailwind CSS:[Tailwind CSSバージョン:3.2.1]
- データベース：MySQL [MySQLバージョン:8.0.26 for Linux on x86_64 (MySQL Community Server - GPL)]


## テーブル設計
以下は、主要なデータベーステーブルとそのフィールドの概要です。

| usersテーブル  |     |     
|------------|---------|     
| id         | PK      |    
| name       |         |     
| email      |         |      
| password   |         |      
| created_at |         |      
| updated_at |         |      

| profilesテーブル |   |
|------------|---------|
| id         | PK      |
| user_id    | FK      |
| nickname   |         |
| img_url    |         |
| postcode   |         |
| address    |         |
| buillding  |         |
| created_at |         |
| updated_at |         |

| itemsテーブル |      |
|------------|---------|
| id         | PK      |
| user_id    | FK      |
| category_id | FK     |
| condition_id | FK    |
| name       |         |
| price      |         |
| description |        |
| img_url     |        |
| created_at |         |
| updated_at |         |

| likesテーブル  |     |
|------------|---------|
| id         | PK      |
| user_id    | FK      |
| item_id    | FK      |
| created_at |         |
| updated_at |         |

| commentsテーブル  |  |
|------------|---------|
| id         | PK      |
| user_id    | FK      |
| item_id    | FK      |
| comment    |         |
| created_at |         |
| updated_at |         |

| sold_itemsテーブル | |
|------------|---------|
| id         | PK      |
| user_id    | FK      |
| item_id    | FK      |
| created_at |         |
| updated_at |         |

| conditionsテーブル | |
|------------|---------|
| id         | PK      |
| condition  |         |
| created_at |         |
| updated_at |         |

| categoriesテーブル | |
|------------|---------|
| id         | PK      |
| category   |         |
| created_at |         |
| updated_at |         |

| category_itemsテーブル | |
|------------|---------|
| id         | PK      |
| user_id    | FK      |
| category_id | FK     |
| created_at |         |
| updated_at |         |

| rolesテーブル |      |
|------------|---------|
| id         | PK      |
| name       |         |
| guard_name |         |
| created_at |         |
| updated_at |         |

| permissionsテーブル | |
|------------|---------|
| id         | PK      |
| name       |         |
| guard_name |         |
| created_at |         |
| updated_at |         |

| role_has_permissionsテーブル | |
|------------|---------|
| role_id    | FK      |
| permission_id | FK   |

| model_has_rolesテーブル | |
|------------|---------|
| role_id    | FK      |
| model_id(user_idと同意味) | FK |
| model_type |         |

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
npm run build

```

##　無事localhostでアクセスできると思います。
必要に応じて、php artisan storage:linkなどもご使用ください。