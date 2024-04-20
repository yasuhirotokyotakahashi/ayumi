<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  profile: Object,
});

const form = useForm({
  nickname:props.profile.nickname,
  postcode: props.profile.postcode, 
  address: props.profile.address,
  building: props.profile.building,
  img: props.profile.img_url,
});

const updateProfile = () => {
  console.log(form);
  form.post(route("user.updateProfile"));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};
</script>

<template>
  <div class="max-w-md mx-auto mt-8">
    <div class="text-center text-xl font-semibold mb-4">プロフィール編集画面</div>
    
    <!-- 現在のプロフィール情報を表示するセクション -->
    <div class="bg-white shadow-md rounded-md p-6 mb-8">
      <div class="mb-4"><strong>ニックネーム:</strong> {{ props.profile.nickname }}</div>
      <div class="mb-4"><strong>郵便番号:</strong> {{ props.profile.postcode }}</div>
      <div class="mb-4"><strong>住所:</strong> {{ props.profile.address }}</div>
      <div class="mb-4"><strong>建物名:</strong> {{ props.profile.building }}</div>
      <div class="mb-4"><strong>画像:</strong><img
          :src="props.profile.img_url"
          alt="Profile Image"
          class="w-24 h-24 object-cover cursor-pointer"
        /> </div>
    </div>

    <!-- プロフィールを編集するフォーム -->
    <div class="bg-white shadow-md rounded-md p-6">
      <form @submit.prevent="updateProfile" class="mt-4">
        <div class="mb-4">
          <label for="nickname" class="block text-sm font-bold text-gray-700">ニックネーム:</label>
          <input id="nickname" v-model="form.nickname" type="text" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:border-blue-500" />
        </div>
        <div class="mb-4">
          <label for="postcode" class="block text-sm font-bold text-gray-700">郵便番号:</label>
          <input id="postcode" v-model="form.postcode" type="text" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:border-blue-500" />
        </div>
        <div class="mb-4">
          <label for="address" class="block text-sm font-bold text-gray-700">住所:</label>
          <input id="address" v-model="form.address" type="text" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:border-blue-500" />
        </div>
        <div class="mb-4">
          <label for="building" class="block text-sm font-bold text-gray-700">建物名:</label>
          <textarea id="building" v-model="form.building" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
        </div>
        <div class="mb-4">
          <label for="img" class="block text-sm font-bold text-gray-700">プロフィール画像:</label>
          <input type="file" name="img" id="img" @input="form.img = $event.target.files[0]" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:border-blue-500" />
        </div>
        <button type="submit" class="w-full bg-green-500 py-2 px-4 rounded-md text-white font-bold text-center focus:outline-none focus:bg-green-600 hover:bg-green-600 transition duration-300 ease-in-out">プロフィールを更新</button>
      </form>
      <Link href="/item" class="block mt-4 bg-gray-300 py-2 px-4 rounded-md text-center font-bold text-gray-800 hover:bg-gray-400 transition duration-300 ease-in-out">戻る</Link>
    </div>
  </div>
</template>
