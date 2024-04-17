<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
  item:Object,
  users: Object,
  permissions: Object,
});

const form = useForm({
  comment: "",
});

const submitComment = (id) => {
  console.log(form); // フォームデータをコンソールに表示
  form.post(route("comment.create", id), form.data());
  // コメント送信後の処理を追加する場合はここに記述
};


</script>

<template>
  <div>
    <div>{{ item.id }}</div>
    <form @submit.prevent="submitComment(item.id)" class="mt-4">
    <div class="mb-4">
      <label for="comment" class="block text-sm font-medium text-gray-700">コメント:</label>
      <textarea id="comment" v-model="form.comment" name="comment" rows="3" class="input-text mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></textarea>
    </div>
    <PrimaryButton type="button"
                        >コメントを投稿</PrimaryButton
                    >
  </form>
  </div>
    
</template>