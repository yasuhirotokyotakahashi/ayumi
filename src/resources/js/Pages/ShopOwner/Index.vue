<template>
    <div>
  <div><Navigation /></div>
  <div class="max-w-xl mx-auto mt-8">
    <form
      @submit.prevent="submit"
      class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
    >
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="category"
        >
          登録ユーザー
        </label>
        <select
          v-model="form.user_id"
          id="user"
          name="user_id"
          class="w-full p-2 border rounded"
        >
          <option
            v-for="user in users"
            :key="user.id"
            :value="user.id"
          >
            {{ user.name }}
          </option>
        </select>
        <p class="text-gray-600 mt-2">商品の種類:</p>
      </div>

      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="condition"
        >
          役割
        </label>
        <select
          v-model="form.role_id"
          id="role"
          name="role_id"
          class="w-full p-2 border rounded"
        >
          <option
            v-for="role in roles"
            :key="role.id"
            :value="role.id"
          >
            {{ role.id }}
          </option>
        </select>
        <p class="text-gray-600 mt-2">商品の状態:</p>
      </div>

      
      <!-- 他のフォームも追加 -->

      <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >
        登録
      </button>
    </form>
  </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";

defineProps({
  users: Object,
  roles: Object,
});

const form = useForm({
  user_id: null,
  role_id: null,
});

function submit() {
  console.log(form); // フォームデータをコンソールに表示
  form.post("/sell/create");
}
</script>
