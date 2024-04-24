<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  mail: {
    type: String,
  },
  body: {
    type: String,
  },
  recipient_id: {
    type: Number,
  },
  recipient_name: {
    type: String,
  },
});

const form = useForm( {
  mail: props.mail,
  body: props.body,
  recipient_id: props.recipient_id,
  recipient_name: props.recipient_name, // recipient_name をフォームに追加
});

const submit = () => {
  console.log(form);
  form.post(route("mail.create"));
};
</script>

<template>
  <div class="flex justify-center">
    <!-- 入力内容確認フォーム -->
    <form @submit.prevent="submit" method="post">
      <h3 class="p-1">ご入力いただいた内容をご確認ください</h3>
      <!-- メールアドレス -->
      <div class="w-40 border-l-4 text-sm p-1 m-1">ご自身のメールアドレス</div>
      <div class="w-40">
        <div class="p-1 m-1 text-sm w-full">{{ $props.mail }}</div>
        <input type="hidden" name="mail" v-model="form.mail" size="25" />
      </div>
      <!-- お問い合わせ内容 -->
      <div class="w-40 border-l-4 text-sm p-1 m-1">お問い合わせ内容</div>
      <div class="w-40">
        <pre class="p-1 m-1 text-sm w-full">{{ props.body }}</pre>
        <input type="hidden" name="message" v-model="form.body" />
      </div>
      <div class="w-40">
        <input type="hidden" name="recipient_id" v-model="form.recipient_id" />
      </div>
      <!-- 送信先名 -->
      <div class="w-40 border-l-4 text-sm p-1 m-1">送信先名</div>
      <div class="w-40">
        <pre class="p-1 m-1 text-sm w-full">{{ props.recipient_name }}</pre>
        <input type="hidden" name="message" v-model="form.recipient_name" />
      </div>
      <!-- お問い合わせ送信ボタン -->
      <button
        type="submit"
        class="border bg-green-200 m-1 p-1 text-sm"
        :disabled="form.processing"
        v-bind:class="{ 'cursor-not-allowed': form.processing }"
      >
        お問い合わせを送信
      </button>
      <!-- 入力画面へ戻るボタン -->
      <Link href="/mail" class="block  bg-gray-300 py-2 px-4 rounded-md text-center">戻る</Link>
      <!-- 送信中止ボタン -->
      <button
        v-if="form.processing"
        @click="form.cancel()"
        type="button"
        class="border bg-red-200 m-1 p-1 text-sm"
      >
        送信中止
      </button>
    </form>
  </div>
</template>

<style scoped>
@media (max-width: 768px) {
  .flex.justify-center {
    justify-content: center;
  }
}
</style>