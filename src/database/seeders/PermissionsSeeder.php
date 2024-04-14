<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission作成
        $manageAdmin = Permission::create(['name' => 'manage_admin']);
        $manageShopOwner = Permission::create(['name' => 'manage_shop_owner']);
        $manageUser = Permission::create(['name' => 'manage_user']);

        // Role作成
        $adminRole = Role::create(['name' => 'admin']);
        $shopOwnerRole = Role::create(['name' => 'shop_owner']);
        $userRole = Role::create(['name' => 'user']);

        // PermissionとRoleを関連付け
        $adminRole->givePermissionTo($manageAdmin);
        $shopOwnerRole->givePermissionTo($manageShopOwner);
        $userRole->givePermissionTo($manageUser);

        // User作成
        $user1 = User::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => bcrypt('xxxxxx'),
        ]);

        $user2 = User::create([
            'name' => '店舗代表者',
            'email' => 'shopowner@example.com',
            'password' => bcrypt('xxxxxx'),
        ]);

        $user3 = User::create([
            'name' => '認証利用者',
            'email' => 'user@example.com',
            'password' => bcrypt('xxxxxx'),
        ]);

        // UserにRoleを割り当て
        $user1->assignRole($adminRole);
        $user2->assignRole([$shopOwnerRole]);
        $user3->assignRole($userRole);
    }
}
