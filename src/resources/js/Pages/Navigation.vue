<template>
  <nav class="bg-gray-800 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex-shrink-0">
          <img
            class="block lg:hidden h-8 w-auto"
            src="/img/logos/workflow-mark-indigo-500.svg"
            alt="Workflow"
          />
          <img
            class="hidden lg:block h-8 w-auto"
            src="/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
            alt="Workflow"
          />
        </div>
        <div class="hidden sm:flex sm:ml-6 space-x-8">
          <template v-if="$page.props.auth.user">
            <NavLink
              v-if="
                $page.props.permissions &&
                $page.props.permissions.includes('manage_admin')
              "
              :href="route('admin.user')"
              class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
              >管理者画面へ</NavLink
            >
            <NavLink
              v-if="
                $page.props.permissions &&
                $page.props.permissions.includes('manage_shop_owner')
              "
              :href="route('admin.user')"
              class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
              >店舗代表者画面へ</NavLink
            >
            <NavLink
            v-if="
                $page.props.permissions &&
                $page.props.permissions.includes('manage_user')
              "
              :href="route('item.sellView')"
              class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
              >出品</NavLink
            >
            <NavLink
              :href="route('user.mypage')"
              class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
              >マイページへ</NavLink
            >
            <NavLink
              :href="route('items.index')"
              class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
              >一覧へ</NavLink
            >
            
            <NavLink
    class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
    @click.prevent="confirmLogout"
>ログアウトへ</NavLink>
          </template>
          <template v-else>
            <NavLink
              :href="route('items.index')"
              class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
              >アイテム一覧へ</NavLink
            >
            <NavLink
              :href="route('login')"
              class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
              >ログインへ</NavLink
            >
            <NavLink
              :href="route('register')"
              class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
              >会員登録へ</NavLink
            >
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link as NavLink } from "@inertiajs/vue3";
import { usePage } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';

const { $inertia } = usePage();
const form = useForm();

const confirmLogout = () => {
    if (confirm("ログアウトしてもよろしいですか？")) {
        form.post(route('logout'));
    }
};

</script>
