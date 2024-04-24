<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";

defineProps({
  users: Object,
  permissions: Object,
});

const form = useForm({
  comment: "",
});

const confirmComment = () => {
  form.get(route("comment.confirm"));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};

const mailUser = () => {
  form.get(route("mail.index"));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};

const deleteUser = (id) => {
  console.log(id);
  form.delete(route("user.delete", id));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};
</script>

<template>
  <div class="container mx-auto px-4">
    <!-- ナビゲーションバー -->
    <div class="mb-4"><Navigation /></div>

    <!-- ボタン群 -->
    <div class="flex flex-col items-center mb-4">
      <!-- ユーザーとショップ交流確認画面へのボタン -->
      <button @click="confirmComment()" class="mb-2 md:mb-0 md:mr-4 w-full md:w-auto text-center text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg shadow-md">
        ユーザーとショップ交流確認画面へ
      </button>

      <!-- メール送信画面へのボタン -->
      <button @click="mailUser()" class="w-full md:w-auto text-center text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg shadow-md">
        メール送信画面へ
      </button>
    </div>

    <!-- ユーザーテーブル -->
    <div class="overflow-x-auto">
      <table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <!-- ヘッダーの省略 -->
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <!-- ユーザー情報の表示 -->
          <tr v-for="user in users" :key="user.id">
            <td class="px-4 md:px-6 py-2 md:py-4 whitespace-nowrap">{{ user?.id || 'N/A' }}</td>
            <td class="px-4 md:px-6 py-2 md:py-4 whitespace-nowrap">{{ user?.name || 'N/A' }}</td>
            <td class="px-4 md:px-6 py-2 md:py-4 whitespace-nowrap">{{ user?.email || 'N/A' }}</td>
            <td class="px-4 md:px-6 py-2 md:py-4 whitespace-nowrap">
              <!-- ユーザー削除ボタン -->
              <button @click="deleteUser(user.id)" class="text-indigo-600 hover:text-indigo-900">
                削除
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
@media (max-width: 768px) {
  /* 768px以下の場合のスタイル */
  .container {
    padding-left: 0.75rem;
    padding-right: 0.75rem;
  }
}
</style>