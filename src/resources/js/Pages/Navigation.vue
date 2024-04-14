<script setup>
import { Link as NavLink } from "@inertiajs/vue3";
</script>

<template>
  <nav class="bg-gray-800 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <div class="hidden sm:-my-px sm:ml-6 sm:flex space-x-8">
            <template v-if="$page.props.auth.user">
              <NavLink
                :href="route('item.sellView')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >出品</NavLink
              >
              <NavLink
                :href="route('user.mypage')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >プロフィールへ
              </NavLink>
              <NavLink
                :href="route('items.index')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >一覧へ</NavLink
              >
              <NavLink
                v-if="
                  $page.props.permissions &&
                  $page.props.permissions.includes('manage_admin')
                "
                :href="route('admin.index')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >管理者画面へ</NavLink
              >
              <NavLink
                :href="route('dashboard')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >ログアウトへ</NavLink
              >
            </template>
            <template v-else>
              <NavLink
                :href="route('items.index')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >一覧へ</NavLink
              >
              <NavLink
                :href="route('login')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >ログインへ</NavLink
              >
            </template>

            <!-- 他のページへのリンクを追加 -->
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

