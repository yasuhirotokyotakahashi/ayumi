<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定
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
        $user = auth()->user();
        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定
            $userName = null;
        }
        $users = User::all();

        $comments = Comment::with('user', 'item')->get();

        return Inertia::render('Admin/Comment', ['users' => $users, 'permissions' => $permissions, 'comments' => $comments,]);
    }
}
