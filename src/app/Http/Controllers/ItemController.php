<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $user = auth()->user();
        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定するか、必要に応じてデフォルトの名前を設定します
            $userName = null;
        }



        return Inertia::render('TopPage', ['items' => $items, 'permissions' => $permissions, 'user' => $user,]);
    }
}
