<template>
  <div>
    <!-- ナビゲーションバー -->
    <div><Navigation /></div>

    <div class="max-w-xl mx-auto mt-8">
      <div v-for="comment in comments" :key="comment.id" class="bg-white shadow-md rounded px-4 py-6 mb-4">
        <div class="border-b border-gray-300 py-4">
          <div class="text-gray-600">{{ comment.item.name }}についてのコメントです</div>
        </div>
        <div class="border-b border-gray-300 py-4">
          <div class="text-gray-600">{{ comment.user.name }}様からのコメント</div>
        </div>
        <div class="py-4">
          <!-- コメント内容 -->
          <div class="font-bold text-lg">コメント内容:</div>
          <div class="text-gray-600">{{ comment.comment }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@media (max-width: 768px) {
  /* 768px以下の場合のスタイル */
  .max-w-xl {
    max-width: 100%;
  }
}
</style>

<script setup>
import Navigation from "@/Pages/Navigation.vue";

defineProps({
  users: Object,
  permissions: Object,
  comments: Object,
});


</script>
