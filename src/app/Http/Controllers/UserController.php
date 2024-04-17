<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    //
    public function mypage()
    {
        // ログインしているユーザーの情報を取得
        $user = auth()->user();

        // ユーザーが購入した商品を取得
        $soldItems = $user->soldItems;

        // ユーザーが出品した商品を取得
        $items = $user->items;

        // ビューにデータを渡してマイページをレンダリング
        return Inertia::render('MyPage', [
            'user' => $user,
            'soldItems' => $soldItems,
            'items' => $items,
        ]);
    }
}
