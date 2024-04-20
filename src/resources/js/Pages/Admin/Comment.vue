<template>
  <div>
    <!-- ナビゲーションバー -->
    <div><Navigation /></div>

   <div class="max-w-xl mx-auto mt-8">
  <div v-for="comment in comments" :key="comment.id" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="flex justify-between items-center border-b border-gray-300 py-4">
      <!-- 商品名 -->
      <div class="w-1/3">
        <div class="font-bold text-lg">商品名:</div>
        <div class="text-gray-600">{{ comment.item.name }}</div>
      </div>
      <!-- ユーザー名 -->
      <div class="w-1/3">
        <div class="font-bold text-lg">ユーザー名:</div>
        <div class="text-gray-600">{{ comment.user.name }}</div>
      </div>
      <!-- コメント内容 -->
      <div class="w-1/3">
        <div class="font-bold text-lg">コメント内容:</div>
        <div class="text-gray-600">{{ comment.comment }}</div>
      </div>
    </div>
  </div>
</div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";

defineProps({
  users: Object,
  permissions: Object,
  comments: Object,
});




</script>
