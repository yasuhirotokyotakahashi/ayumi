<script setup>
import { Link } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";


defineProps({
  items: Object,
  permissions: Object,
  user: Object,
});

const redirectToDetail = (itemId) => {
  // 詳細ページへのリダイレクト
  window.location.href = route("item.detail", itemId);
};
</script>

<template>
  <div>
  <div><Navigation /></div>
  <div class="grid grid-cols-5 gap-4">
    <!-- 画像を横並びで表示 -->
    <div v-for="item in items" :key="item.id" class="mb-4">
      <img
        :src="item.img_url"
        alt="Item Image"
        class="w-24 h-24 object-cover cursor-pointer"
        @click="redirectToDetail(item.id)"
      />
    </div>
  </div>
  </div>
</template>