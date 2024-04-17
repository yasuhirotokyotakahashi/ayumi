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
  <div>
    <h2 class="text-lg border-b p-1">
      <Link :href="route('mail.index')" class="text-blue-700 underline">
        お問い合わせ
      </Link>
    </h2>

    <form @submit.prevent="submit" method="post">
      <h3 class="border-l-4 p-1">ご入力いただいた内容をご確認ください</h3>
      <div class="w-40 border-l-4 text-sm p-1 m-1">ご自身のメールアドレス</div>
      <div class="w-40">
        <div class="p-1 m-1 text-sm w-full">
          {{ $props.mail }}
        </div>
        <input type="hidden" name="mail" v-model="form.mail" size="25" />
      </div>
      <div class="w-40 border-l-4 text-sm p-1 m-1">お問い合わせ内容</div>
      <div class="w-40">
        <pre class="p-1 m-1 text-sm w-full">{{ props.body }}</pre>
        <input type="hidden" name="message" v-model="form.body" />
      </div>
      <div class="w-40 border-l-4 text-sm p-1 m-1">
        送信先ID
      </div>
      <div class="w-40">
        <pre class="p-1 m-1 text-sm w-full">{{ props.recipient_id }}</pre>
        <input type="hidden" name="recipient_id" v-model="form.recipient_id" />
      </div>
      <div class="w-40 border-l-4 text-sm p-1 m-1">送信先名</div>
      <div class="w-40">
        <pre class="p-1 m-1 text-sm w-full">{{ props.recipient_name }}</pre>
        <input type="hidden" name="message" v-model="form.recipient_name" />
      </div>
      <button
        type="submit"
        class="border bg-green-200 m-1 p-1 text-sm"
        :disabled="form.processing"
        v-bind:class="{ 'cursor-not-allowed': form.processing }"
      >
        お問い合わせを送信
      </button>
      <button
        @click="back"
        type="button"
        class="border bg-gray-200 m-1 p-1 text-sm"
      >
        入力画面へ戻る
      </button>
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