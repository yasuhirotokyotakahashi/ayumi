<script setup>
import { useForm } from "@inertiajs/vue3";
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
    <div><Navigation /></div>
    <div class="max-w-md mx-auto p-6">

      <!-- お問い合わせフォーム -->
      <div class="bg-white shadow-md rounded-md p-6">

        <!-- 入力フォームの説明 -->
        <h3 class="text-lg font-semibold border-l-4 pl-1 mb-4">メールアドレスとお問い合わせ内容をご入力ください</h3>

        <!-- エラーメッセージ -->
        <div v-if="form.hasErrors" class="border border-red-100 p-1 m-1 text-sm text-red-600">
          入力された値をもう一度確認してください。
          <ul class="list-disc list-inside">
            <li v-for="error in form.errors">{{ error }}</li>
          </ul>
        </div>

        <!-- 送信先選択 -->
        <div class="flex flex-wrap mb-4">
          <div class="w-full md:w-1/3 border-l-4 text-sm p-1">送信先</div>
          <div class="w-full md:w-2/3">
            <select
              v-model="form.recipient_id"
              class="p-1 text-sm w-full border"
              :class="{ 'border-red-300': form.errors.recipient_id }"
            >
              <option value="" disabled selected>送信先を選択</option>
              <option v-for="user in users" :key="user.id" :value="user.id">
                {{ user.name }} ({{ user.email }})
              </option>
            </select>
          </div>
        </div>

        <!-- メールアドレス入力 -->
        <div class="flex flex-wrap mb-4">
          <div class="w-full md:w-1/3 border-l-4 text-sm p-1">メールアドレス</div>
          <div class="w-full md:w-2/3">
            <input
              type="text"
              name="mail"
              v-model="form.mail"
              class="p-1 text-sm w-full border"
              :class="{ 'border-red-300': form.errors.mail }"
            />
          </div>
        </div>
        <div v-show="form.errors.mail" class="p-1 m-1 text-sm text-red-400">
          {{ form.errors.mail }}
        </div>

        <!-- お問い合わせ内容入力 -->
        <div class="flex flex-wrap mb-4">
          <div class="w-full md:w-1/3 border-l-4 text-sm p-1">お問い合わせ内容</div>
          <div class="w-full md:w-2/3">
            <textarea
              name="body"
              v-model="form.body"
              rows="5"
              class="p-1 text-sm w-full h-32 border"
              :class="{ 'border-red-300': form.errors.body }"
            ></textarea>
          </div>
        </div>
        <div v-show="form.errors.body" class="p-1 m-1 text-sm text-red-400">
          {{ form.errors.body }}
        </div>

        <!-- ボタン類 -->
        <div class="flex flex-wrap mb-4 justify-center md:justify-between">
          <!-- 送信ボタン -->
          <button
            @click="submit"
            class="border bg-green-200 m-1 p-1 text-sm"
            :disabled="form.processing"
            :class="{ 'cursor-not-allowed': form.processing }"
          >
            確認画面へ進む
          </button>

          <!-- リセットボタン -->
          <button
            @click="form.reset()"
            type="reset"
            class="border bg-gray-200 m-1 p-1 text-sm"
            :disabled="!form.isDirty"
            :class="{ 'cursor-not-allowed': !form.isDirty }"
          >
            リセット
          </button>

          <!-- 送信中止ボタン -->
          <button
            v-if="form.processing"
            @click="form.cancel()"
            type="button"
            class="border bg-red-200 m-1 p-1 text-sm"
          >
            送信中止
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@media (max-width: 768px) {
  .max-w-md {
    max-width: 100%;
  }

  .flex-wrap {
    flex-wrap: wrap;
  }

  .w-full {
    width: 100%;
  }

  
}
</style>