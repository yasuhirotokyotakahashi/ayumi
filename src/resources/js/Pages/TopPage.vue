<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import Navigation from "@/Pages/Navigation.vue";


defineProps({
  items: Object,
  likeItems:Object,
  permissions: Object,
  user: Object,
});

const redirectToDetail = (itemId) => {
  // 詳細ページへのリダイレクト
  window.location.href = route("item.detail", itemId);
};

const display = ref("purchased"); // 初期表示は購入品一覧

function toggleDisplay(type) {
  display.value = type;
}
</script>

<template>
  <div>
    <!-- ナビゲーションバー -->
    <div><Navigation /></div>
    
    <!-- 切り替え用のボタン -->
    <div class="flex mb-4 space-x-4">
      <button
        @click="toggleDisplay('purchased')"
        :class="{
          'bg-blue-500 text-white': display === 'purchased',
          'bg-gray-200': display !== 'purchased',
        }"
        class="px-4 py-2 rounded-md"
      >
        全一覧
      </button>
      <button
        @click="toggleDisplay('sold')"
        :class="{
          'bg-blue-500 text-white': display === 'sold',
          'bg-gray-200': display !== 'sold',
        }"
        class="px-4 py-2 rounded-md"
      >
        お気に入り一覧
      </button>
    </div>

    <!-- アイテム表示 -->
    <div v-if="display === 'purchased'" class="sm:grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 sm:gap-4">
      <!-- 画像を横並びで表示 -->
      <div v-for="item in items" :key="item.id" class="mb-4">
        <img
          :src="item.img_url"
          alt="Item Image"
          class="w-full h-48 object-cover cursor-pointer"
          @click="redirectToDetail(item.id)"
        />
      </div>
    </div>
    <div v-else-if="display === 'sold'" class="sm:grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 sm:gap-4">
      <!-- 画像を横並びで表示 -->
      <div v-for="item in likeItems" :key="item.id" class="mb-4">
        <img
          :src="item.img_url"
          alt="Item Image"
          class="w-full h-48 object-cover cursor-pointer"
          @click="redirectToDetail(item.id)"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
/* スマートフォン用のレスポンシブデザイン */
@media (min-width: 768px) {
  .sm\:grid-cols-2 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
  .md\:grid-cols-3 {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
  .lg\:grid-cols-5 {
    grid-template-columns: repeat(5, minmax(0, 1fr));
  }
}
</style>