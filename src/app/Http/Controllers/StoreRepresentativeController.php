<?php

namespace App\Http\Controllers;

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

        return Inertia::render('ShopOwner/Index', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }
}
