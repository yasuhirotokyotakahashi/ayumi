<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div>
    <!-- お問い合わせページへのリンク -->
    <h2 class="text-lg border-b border-blue-700 p-1">
      <Link :href="route('mail.index')" class="text-blue-700 underline">
        お問い合わせ
      </Link>
    </h2>

    <!-- お問い合わせ送信完了メッセージ -->
    <h3 class="border-l-4 border-blue-700 p-1">お問い合わせが送信されました</h3>
  </div>
</template>