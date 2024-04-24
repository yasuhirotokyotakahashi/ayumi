<template>
  <div>
    <div><Navigation /></div>
    <div class="max-w-3xl mx-auto p-6">
      <h1 class="text-3xl font-bold mb-6">{{ user.name }}のマイページ</h1>
  <ul>
      <li v-for="comment in userComments" :key="comment.id" class="mb-2">
    {{ comment.item.name }}への{{ comment.comment }}というコメント
    <button @click="deleteComment(comment.id)" class="text-red-500">削除しますか？</button>
      </li>
  </ul>
      <NavLink
        :href="route('user.profile')"
        class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
      >プロフィール編集画面へ</NavLink>

      <!-- 切り替え用のボタン -->
      <div class="flex flex-col md:flex-row mb-4 space-y-2 md:space-y-0 md:space-x-4">
        <button
          @click="toggleDisplay('purchased')"
          :class="{
            'bg-blue-500 text-white': display === 'purchased',
            'bg-gray-200': display !== 'purchased',
          }"
          class="w-full md:w-auto px-4 py-2 rounded-md"
        >
          購入品一覧
        </button>
        <button
          @click="toggleDisplay('sold')"
          :class="{
            'bg-blue-500 text-white': display === 'sold',
            'bg-gray-200': display !== 'sold',
          }"
          class="w-full md:w-auto px-4 py-2 rounded-md"
        >
          出品品一覧
        </button>
      </div>

      <!-- 購入品一覧 -->
      <div v-if="display === 'purchased'" class="mb-8">
        <h2 class="text-lg font-semibold mb-4">購入品一覧</h2>
        <ul>
          <li v-for="item in soldItems" :key="item.id" class="mb-2">
            {{ item.name }}
          </li>
        </ul>
      </div>

      <!-- 出品品一覧 -->
      <div v-else-if="display === 'sold'" class="mb-8">
        <h2 class="text-lg font-semibold mb-4">出品品一覧</h2>
        <ul>
          <li v-for="item in items" :key="item.id" class="mb-2">
            {{ item.name }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>
@media (max-width: 768px) {
  /* スマートフォン用のスタイル */
  .w-full {
    width: 100%;
  }
  .md:w-auto {
    width: auto;
  }
  .md:flex-col {
    flex-direction: column;
  }
  .md:space-y-0 {
    margin-top: 0;
    margin-left: 0;
  }
}
</style>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { Link as NavLink } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";

const form = useForm({
  comment: "",
});

defineProps({
  user: Object,
  soldItems: Object,
  items: Object,
  userComments: Object,
  permissions: Object,
});

const display = ref("purchased"); // 初期表示は購入品一覧

function toggleDisplay(type) {
  display.value = type;
}

const deleteComment = (id) => {
  console.log(id);
  form.delete(route("comment.delete", id));
};

</script>