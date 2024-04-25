<script setup>
import { useForm } from "@inertiajs/vue3";
import Navigation from "@/Pages/Navigation.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from '@/Components/InputError.vue';

const props = defineProps({
  item:Object,
  users: Object,
  permissions: Object,
  errors:Object,
});

const form = useForm({
  comment: "",
});

const confirmComment = () => {
    if (confirm("本当にコメントしますか？")) {
      submitComment(props.item.id);
    }
};

const submitComment = (id) => {
  console.log(form); // フォームデータをコンソールに表示
  form.post(route("comment.create", id));
  // コメント送信後の処理を追加する場合はここに記述
};


</script>

<template>
  <div>
  <div><Navigation /></div>
  <div class="max-w-md mx-auto">
    
    <div>{{ item.name }}へのコメント</div>
    <form @submit.prevent="confirmComment(item.id)" class="mt-4">
      <div class="mb-4">
        <label for="comment" class="block text-sm font-medium text-gray-700">コメント:</label>
        <textarea id="comment" v-model="form.comment" name="comment" rows="3" class="input-text mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></textarea>
      </div>
      <InputError class="mt-2" :message="form.errors.comment" />
      <PrimaryButton type="submit" class="w-full">コメントを投稿</PrimaryButton>
    </form>
  </div>
  </div>
</template>

<style scoped>
@media (max-width: 768px) {
  /* スマートフォン用のスタイル */
  .form-container {
    width: 90%;
    margin: 0 auto;
  }
}
</style>