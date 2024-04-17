<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";

defineProps({
  users: Object,
  permissions: Object,
});

const form = useForm({
  comment: "",
});

const mailUser = () => {
  form.get(route("contact.index"));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};

const deleteUser = (id) => {
  console.log(id);
  form.delete(route("user.delete", id));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};
</script>

<template>
<div>
  <div><Navigation /></div>
  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <!-- ヘッダーの省略 -->
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      <tr v-for="user in users" :key="user.id">
        <td class="px-6 py-4 whitespace-nowrap">{{ user.id }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ user.name }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ user.email }}</td>
        <td class="px-6 py-4 whitespace-nowrap">
          <button
            @click="mailUser()"
            class="text-indigo-600 hover:text-indigo-900"
          >
            Mail
          </button>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
          <button
            @click="deleteUser(user.id)"
            class="text-indigo-600 hover:text-indigo-900"
          >
            Delete
          </button>
        </td>
      </tr>
    </tbody>
  </table>
  </div>
</template>