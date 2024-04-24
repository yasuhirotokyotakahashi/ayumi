<template>
  <div>
    <div><Navigation /></div>
    <!-- ユーザーに役割を割り当てるフォーム -->
    <div class="max-w-xl mx-auto mt-8">
      <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label for="user" class="block text-gray-700 text-sm font-bold mb-2">ユーザー:</label>
          <select v-model="form.user_id" id="user" name="user_id" class="w-full p-2 border rounded">
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}様</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="role" class="block text-gray-700 text-sm font-bold mb-2">役割:</label>
          <select v-model="form.role_id" id="role" name="role_id" class="w-full p-2 border rounded">
            <option value="3">認証ユーザー権限</option>
          </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">登録</button>
      </form>
    </div>

    <!-- 割り当てられた役割とユーザーの一覧 -->
    <div class="max-w-xl mx-auto mt-8">
      <div v-for="roleAssignedUser in roleAssignedUsers" :key="roleAssignedUser.id" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="flex justify-between items-center border-b border-gray-300 py-4">
          <div class="text-lg font-bold">{{ roleAssignedUser.role.name }}</div>
          <div class="text-gray-600">{{ roleAssignedUser.user.name }}</div>
          <button @click="removeRole(roleAssignedUser.user.id, roleAssignedUser.role.id)" class="text-red-500 hover:text-red-700">削除</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@media (max-width: 768px) {
  /* スマートフォン用のスタイル */
  .max-w-xl {
    max-width: 90%;
    margin: 0 auto;
  }
}
</style>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";

defineProps({
  users: Object,
  roles: Object,
  roleAssignedUsers: Object,
});

const form = useForm({
  user_id: null,
  role_id: null,
});

function submit() {
  console.log(form); // フォームデータをコンソールに表示
  form.post("/shop");
}


const removeRole = (user_id, role_id) => {
  form.user_id= user_id,
    form.role_id= role_id,
  console.log(user_id, role_id);
  form.post("/shop/remove");
};


</script>
