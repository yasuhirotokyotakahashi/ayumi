<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        // ログインしているかどうかをチェック
        $user = auth()->user();
        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定するか、必要に応じてデフォルトの名前を設定します
            $userName = null;
        }
        $users = User::all();

        return Inertia::render('Admin/Index', ['users' => $users, 'permissions' => $permissions]);
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('items.index');
    }

    public function confirm()
    {
        // ログインしているかどうかをチェック
        $user = auth()->user();
        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定するか、必要に応じてデフォルトの名前を設定します
            $userName = null;
        }
        $users = User::all();

        $comments = Comment::with('user', 'item')->get();

        return Inertia::render('Admin/Comment', ['users' => $users, 'permissions' => $permissions, 'comments' => $comments,]);
    }
}
