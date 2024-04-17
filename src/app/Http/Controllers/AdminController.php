<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
}
