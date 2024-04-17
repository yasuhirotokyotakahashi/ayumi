<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import Navigation from "@/Pages/Navigation.vue";

const props = defineProps({
  item: Object,
  likesCount: Number,
  commentsCount: Number,
  likedItemIds: Object,
  permissions: Object,
});

const form = useForm({
  comment: "",
});

const isLiked = ref(props.likedItemIds.includes(props.item.id));

const submitComment = (id) => {
  console.log(form); // フォームデータをコンソールに表示
  form.post(route("comment.store", id), form.data());
  // コメント送信後の処理を追加する場合はここに記述
};

const deleteItem = (id) => {
  console.log(id);
  form.delete(route("items.delete", id));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};

const editItem = (id) => {
  console.log(id);
  form.get(route("items.edit", id));
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};

const confirmLike = () => {
  if (isLiked.value) {
    if (confirm("本当にお気に入り解除しますか？")) {
      cancelItem(props.item.id);
    }
  } else {
    if (confirm("本当にお気に入り登録しますか？")) {
      likeItem(props.item.id);
    }
  }
};

const likeItem = (id) => {
  console.log(id);
  form.post(route("like.create", id));
  isLiked.value = true; // お気に入り状態を反転
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};

const cancelItem = (id) => {
  console.log(id);
  form.post(route("like.destroy", id));
  isLiked.value = false;
};

const purchaseItem = (id) => {
  form.get(route("purchase.index", id));
};

const commentItem = (itemId) => {
  window.location.href =route("comment.index", itemId );
};

const mailItem = (itemId) => {
  window.location.href =route("mail.index", itemId );
};

</script>

<template>
    <div>
  <div><Navigation /></div>
  <div class="max-w-md mx-auto p-6 bg-white shadow-md rounded-md mt-8">
  <!-- 画像と商品情報の表示 -->
  <div class="flex flex-col md:flex-row items-center md:items-start justify-between space-y-4 md:space-y-0 md:space-x-8">
    <!-- 商品画像の表示 -->
    <div class="md:w-1/3">
      <img :src="item.img_url" alt="Item Image" class="w-full h-auto" />
    </div>
    <!-- 商品情報の表示 -->
    <div class="md:w-2/3 space-y-4">
      <div>
        <div class="text-lg font-semibold">{{ item.name }}</div>
        <div class="text-gray-500">{{ item.price }}</div>
        <div class="text-gray-500">
          <span>{{ commentsCount }} コメント</span>
          <span class="mx-2">|</span>
          <span>{{ likesCount }} いいね</span>
        </div>
      </div>
      <div class="flex justify-between items-center md:items-start">
        <div>
          <button @click="purchaseItem(item.id)" class="btn-blue mr-2">
            購入する
          </button>
          <button @click="commentItem(item.id)" class="btn-blue mr-2">
            コメントする
          </button>
          <button @click="mailItem(item.id)" class="btn-blue mr-2">
            メールを送る
          </button>
          <button @click="confirmLike" class="btn-red flex items-center">
            <span class="mr-2">
              <i :class="[isLiked ? 'fas' : 'far', 'fa-heart']"></i>
            </span>
            <span>
              {{ isLiked ? "お気に入り解除" : "お気に入り登録" }}
            </span>
          </button>
        </div>
        <div>
          <button v-if="$page.props.permissions && $page.props.permissions.includes('manage_admin')" @click="deleteItem(item.id)" class="btn-red">削除</button>
          <button v-if="$page.props.permissions && $page.props.permissions.includes('manage_admin')" @click="editItem(item.id)" class="btn-red">修正</button>
        </div>
      </div>
      <div>
        <div class="mt-4"><strong>説明:</strong> {{ item.description }}</div>
        <div class="mt-4">
          <strong>状態:</strong>
          {{ item.condition ? item.condition.condition : "" }}
        </div>
        <div class="mt-4">
          <strong>カテゴリー:</strong>
          {{ item.category ? item.category.category : "" }}
        </div>
      </div>
    </div>
  </div>
  <!-- コメントフォーム -->
  <form @submit.prevent="submitComment(item.id)" class="mt-4">
    <label for="comment" class="block text-sm font-medium text-gray-700">コメント:</label>
    <textarea id="comment" v-model="form.comment" name="comment" rows="3" class="input-text mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></textarea>
    <button type="submit" class="btn-blue mt-4">コメント投稿</button>
  </form>
  <!-- 戻るボタン -->
  <Link href="/item" class="block mt-4 bg-gray-300 py-2 px-4 rounded-md text-center">戻る</Link>
</div>
  </div>
</template>