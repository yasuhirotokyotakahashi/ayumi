<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{
    public function create($itemId)
    {


        // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();
        Like::create([
            'user_id' => $userId,
            'item_id' => $itemId,
        ]);
        return
            Redirect::route('item.detail', ['item' => $itemId]);
    }

    public function destroy($itemId)
    {


        // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        $existingFavorite = Like::where('user_id', $userId)
            ->where('item_id', $itemId)
            ->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
        }

        return Redirect::route('item.detail', ['item' => $itemId]); // プロフィールが存在しない場合はプロフィール作成ページにリダイレクト

    }
}
