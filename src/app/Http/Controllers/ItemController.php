<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemsRequest;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $user = auth()->user();
        $likeItems = [];

        // ログインしている場合のみ処理を実行
        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
            $likeItems = $user->likes;
        } else {
            // ログインしていない場合は権限を空にする
            $permissions = [];
        }

        $unsoldItems = $items->reject(function ($item) {
            return $item->soldItems()->exists();
        });

        return Inertia::render('TopPage', ['items' => $unsoldItems, 'permissions' => $permissions, 'user' => $user, 'likeItems' => $likeItems]);
    }

    public function detail($id)
    {
        $user = Auth::user();
        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定するか、必要に応じてデフォルトの名前を設定します
            $userName = null;
        }
        $likedItems =
            $user ? $user->Likes()->get() : collect(); // nullチェックを追加し、未登録のLikesテーブルの場合に空のコレクションを使用します
        $likedItemIds = $likedItems->pluck('id')->toArray();
        $item = Item::with(['category', 'condition'])->find($id);
        $category = $item->category;
        $condition = $item->condition;
        $commentsCount = $item->comments()->count(); // コメントの総数を取得
        $likesCount = $item->Likes ? $item->Likes->count() : 0; // nullチェックを含むように変更


        return Inertia::render('ItemDetailPage', [
            'item' => $item,
            'category' => $category,
            'condition' => $condition,
            'commentsCount' => $commentsCount, // コメントの総数をビューに渡す
            'likesCount' => $likesCount, // いいねの総数をビューに渡す
            'likedItemIds' => $likedItemIds,
            'permissions' => $permissions,

        ]);
    }

    public function sellView()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        // ログインユーザーの権限を取得
        $permissions = auth()->user()->getAllPermissions()->pluck('name')->toArray();

        return Inertia::render('SellPage', [
            'conditions' => $conditions,
            'categories' => $categories,
            'permissions' => $permissions,
        ]);
    }

    public function sellCreate(ItemsRequest $request)
    {

        // フォームデータのバリデーションを行う
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $userId = Auth::id();


        // 画像アップロード処理
        if ($request->file('img') !== null) {
            // 画像を保存するディレクトリを指定
            $image = $request->file('img');
            $filename = $image->getClientOriginalName(); // オリジナルのファイル名を取得
            $path = $image->storeAs('public/images', $filename); // ファイルをstorage/app/public/imagesに保存し、publicディスクを使用



            // 保存された画像へのURLを取得
            $url = asset('storage/' . str_replace('public/', '', $path));

            // Eloquentを使用してデータベースに保存
            Item::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'condition_id' => $request->input('condition_id'),
                'img_url' => $url,
                'user_id' => $userId,
                // 他のフォームフィールドに対応する項目を追加
            ]);

            // ここに他の Item モデルに対する処理を追加することができます


            return redirect()->route('items.index');
        }
    }
}
