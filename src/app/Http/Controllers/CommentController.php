<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function index($id)
    {

        $item = Item::find($id);

        // ログインしているかどうかをチェック
        $user = Auth::user();
        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定するか、必要に応じてデフォルトの名前を設定します
            $userName = null;
        }

        $users = User::all();
        return Inertia::render('CommentForm', ['item' => $item,]);
    }

    public function create(Request $request, $id)
    {

        // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // コメントを保存
        Comment::create([
            'user_id' => $userId,
            'item_id' => $id,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('items.index');
    }
}
