<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRole;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class StoreRepresentativeController extends Controller
{
    public function inviteStaff(Request $request)
    {
        $users = User::all();
        $roles = Role::all();
        // ログインユーザーの権限を取得
        $permissions = auth()->user()->getAllPermissions()->pluck('name')->toArray();


        $roleAssignedUsers = ModelHasRole::with('user', 'role')->get();


        return Inertia::render('ShopOwner/Index', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
            'roleAssignedUsers' => $roleAssignedUsers,
        ]);
    }

    public function assignRole(Request $request)
    {
        // フォームからユーザーIDと役割IDを取得
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');

        // ユーザーを取得
        $user = User::findOrFail($userId);

        // 役割を取得
        $role = Role::findOrFail($roleId);

        // ユーザーに役割を付与
        $user->assignRole($role);

        // 成功したらリダイレクトなど適切な処理を行う
        return redirect()->back()->with('success', '役割を割り当てました。');
    }

    public function removeRole(Request $request)
    {
        // フォームからユーザーIDと役割IDを取得
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');

        // ユーザーを取得
        $user = User::findOrFail($userId);

        // 役割を取得
        $role = Role::findOrFail($roleId);

        // ユーザーから役割を削除
        $user->removeRole($role);

        return redirect()->back()->with('success', '役割を割り当てました。');
    }
}
