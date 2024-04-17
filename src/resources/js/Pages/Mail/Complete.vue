<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div>
    <h2 class="text-lg border-b p-1">
      <Link :href="route('mail.index')" class="text-blue-700 underline">
        お問い合わせ
      </Link>
    </h2>

    <h3 class="border-l-4 p-1">お問い合わせが送信されました</h3>
  </div>
</template>