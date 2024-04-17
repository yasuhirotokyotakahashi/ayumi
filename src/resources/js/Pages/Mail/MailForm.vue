<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";

defineProps({
  users: Object,
  permissions: Object,
});

const form = useForm("Contact", {
  mail: null,
  body: null,
  recipient_id: null,
});

const submit = () => {
  console.log(form);
  form.post(route("mail.confirm"));
};
</script>

<template>
  <div>

  <div>
    <h2 class="text-lg border-b p-1">
      <div>お問い合わせ</div>
    </h2>

    <form @submit.prevent="submit">
      <h3 class="border-l-4 p-1">
        メールアドレスとお問い合わせ内容をご入力ください
      </h3>

      <div
        v-if="form.hasErrors"
        class="border border-red-100 p-1 m-1 text-sm text-red-600"
      >
        入力された値をもう一度確認してください。
        <ul class="list-disc list-inside">
          <li v-for="error in form.errors">{{ error }}</li>
        </ul>
      </div>

      <div class="w-40 border-l-4 text-sm p-1 m-1">送信先</div>
      <div class="w-80">
        <select
          v-model="form.recipient_id"
          class="p-1 m-1 text-sm w-full border"
          v-bind:class="{ 'border-red-300': form.errors.recipient_id }"
        >
          <option value="" disabled selected>送信先を選択</option>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.name }} ({{ user.email }})
          </option>
        </select>
      </div>

      <div class="w-40 border-l-4 text-sm p-1 m-1">メールアドレス</div>
      <div class="w-80">
        <input
          type="text"
          name="mail"
          v-model="form.mail"
          class="p-1 m-1 text-sm w-full border"
          v-bind:class="{ 'border-red-300': form.errors.mail }"
        />
      </div>
      <div v-show="form.errors.mail" class="p-1 m-1 text-sm text-red-400">
        {{ form.errors.mail }}
      </div>

      <div class="w-40 border-l-4 text-sm p-1 m-1">お問い合わせ内容</div>
      <div class="w-80">
        <textarea
          name="body"
          v-model="form.body"
          class="p-1 m-1 text-sm w-full h-32 border"
          v-bind:class="{ 'border-red-300': form.errors.body }"
        />
      </div>
      <div v-show="form.errors.body" class="p-1 m-1 text-sm text-red-400">
        {{ form.errors.body }}
      </div>

      <button
        type="submit"
        class="border bg-green-200 m-1 p-1 text-sm"
        :disabled="form.processing"
        v-bind:class="{ 'cursor-not-allowed': form.processing }"
      >
        確認画面へ進む
      </button>
      <button
        @click="form.reset()"
        type="reset"
        class="border bg-gray-200 m-1 p-1 text-sm"
        :disabled="!form.isDirty"
        v-bind:class="{ 'cursor-not-allowed': !form.isDirty }"
      >
        リセット
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
  </div>
</template>