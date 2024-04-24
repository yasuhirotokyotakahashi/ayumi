<template>
  <div>
    <!-- ナビゲーションバー -->
    <div><Navigation /></div>

    <!-- フォーム -->
    <div class="max-w-xl mx-auto mt-8">
      <form
        @submit.prevent="submit"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
      >
        <!-- カテゴリー選択 -->
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-bold mb-2"
            for="category"
          >
            カテゴリー
          </label>
          <select
            v-model="form.category_id"
            id="category"
            name="category_id"
            class="w-full p-2 border rounded"
          >
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.category }}
            </option>
          </select>
          <InputError class="mt-2" :message="form.errors.category_id" />
        </div>

        <!-- 商品の状態選択 -->
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-bold mb-2"
            for="condition"
          >
            商品の状態
          </label>
          <select
            v-model="form.condition_id"
            id="condition"
            name="condition_id"
            class="w-full p-2 border rounded"
          >
            <option
              v-for="condition in conditions"
              :key="condition.id"
              :value="condition.id"
            >
              {{ condition.condition }}
            </option>
          </select>
          <InputError class="mt-2" :message="form.errors.condition_id" />
        </div>

        <!-- 商品名入力 -->
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-bold mb-2"
            for="itemName"
          >
            商品名
          </label>
          <input
            v-model="form.name"
            type="text"
            id="itemName"
            name="name"
            class="w-full p-2 border rounded"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <!-- 商品価格入力 -->
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-bold mb-2"
            for="itemPrice"
          >
            商品価格
          </label>
          <input
            v-model="form.price"
            type="text"
            id="itemPrice"
            name="price"
            class="w-full p-2 border rounded"
          />
          <InputError class="mt-2" :message="form.errors.price" />
        </div>

        <!-- 商品説明入力 -->
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-bold mb-2"
            for="itemDescription"
          >
            商品説明
          </label>
          <input
            v-model="form.description"
            type="text"
            id="itemDescription"
            name="description"
            class="w-full p-2 border rounded"
          />
          <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <!-- 商品画像選択 -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="img">
            商品画像
          </label>
          <input
            type="file"
            name="img"
            id="img"
            @input="form.img = $event.target.files[0]"
            class="w-full p-2 border rounded"
          />
          <InputError class="mt-2" :message="form.errors.img" />
        </div>

        <!-- 登録ボタン -->
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full"
        >
          登録
        </button>
      </form>
    </div>
  </div>
</template>

<style scoped>
@media (max-width: 768px) {
  /* スマートフォン用のスタイル */
  .w-full {
    width: 100%;
  }
}
</style>


<script setup>
import { useForm } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";
import InputError from '@/Components/InputError.vue';

defineProps({
  conditions: Object,
  categories: Object,
  errors:Object,
});

const form = useForm({
  name: null,
  price: null,
  description: null,
  img: null,
  category_id: null,
  condition_id: null,
});

function submit() {
  console.log(form); // フォームデータをコンソールに表示
  form.post("/sell/create");
}
</script>
