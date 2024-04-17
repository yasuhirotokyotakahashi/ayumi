<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  profile: Object,
});

const form = useForm({
   postcode: '', // プロフィールが存在しない場合は空文字列をセット
   address: '',
   building:  '',
   img: '',
});

const updateProfile = () => {
  console.log(form);
  form.post(route("purchase.updateAddress"));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};
</script>

<template>
  <div class="max-w-md mx-auto p-6 bg-white shadow-md rounded-md mt-8">
    <form @submit.prevent="updateProfile">
      <div>
        <div class="mb-4"><strong>ID:</strong> {{ props.profile.id }}</div>
        <div class="mb-4">
          <label for="name"><strong>郵便番号:</strong></label>
          <input id="name" v-model="form.postcode" type="text" />
        </div>
        <div class="mb-4">
          <label for="address"><strong>住所:</strong></label>
          <input id="address" v-model="form.address" type="text" />
        </div>
        <div class="mt-4">
          <label for="building"><strong>建物名:</strong></label>
          <textarea id="building" v-model="form.building"></textarea>
        </div>
      </div>
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
      </div>
      <button
        type="submit"
        class="bg-green-500 py-2 px-4 rounded-md text-white text-center"
      >
        プロフィール確定
      </button>
      <Link
        href="/item"
        class="block mt-4 bg-gray-300 py-2 px-4 rounded-md text-center"
        >戻る</Link
      >
    </form>
  </div>
</template>
