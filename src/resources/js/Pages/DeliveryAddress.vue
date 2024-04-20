<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";

const props = defineProps({
  profile: Object,
  permissions: Object,
});

const form = useForm({
   postcode: '', // プロフィールが存在しない場合は空文字列をセット
   address: '',
   building:  '',
});

const confirmUpdate = () => {
  if (confirm("配送先を確定しますか？")) {
    updateProfile();
  }
};

const updateProfile = () => {
  console.log(form);
  form.post(route("purchase.updateAddress"));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};
</script>

<template>
  <div>
    <div><Navigation /></div>
    <div class="max-w-md mx-auto p-6 bg-white shadow-md rounded-md mt-8">
      <form @submit.prevent="confirmUpdate" class="space-y-4">
        <div>
          <div class="mb-4">
            <label for="postcode" class="block text-sm font-bold">郵便番号:</label>
            <input id="postcode" v-model="form.postcode" type="text" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:border-blue-500" />
          </div>
          <div class="mb-4">
            <label for="address" class="block text-sm font-bold">住所:</label>
            <input id="address" v-model="form.address" type="text" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:border-blue-500" />
          </div>
          <div class="mt-4">
            <label for="building" class="block text-sm font-bold">建物名:</label>
            <textarea id="building" v-model="form.building" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
          </div>
        </div>
        <div>
          <button type="submit" class="w-full bg-green-500 py-2 px-4 rounded-md text-white font-bold text-center focus:outline-none focus:bg-green-600 hover:bg-green-600 transition duration-300 ease-in-out">配送先を確定する</button>
          <Link href="/" class="block mt-4 bg-gray-300 py-2 px-4 rounded-md text-center font-bold text-gray-800 hover:bg-gray-400 transition duration-300 ease-in-out">戻る</Link>
        </div>
      </form>
    </div>
  </div>
</template>
