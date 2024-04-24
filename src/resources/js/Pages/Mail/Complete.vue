<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div class="flex flex-col items-center">
    <!-- メッセージ -->
    <h3 class="p-1">お問い合わせが送信されました</h3>
    <!-- リンク -->
    <Link href="/" class="block bg-gray-300 py-2 px-4 rounded-md text-center mt-4">ホームに戻る</Link>
  </div>
</template>

<style scoped>
@media (max-width: 768px) {
  .flex.justify-center {
    justify-content: center;
  }
}
</style>