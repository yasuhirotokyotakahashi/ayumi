<template>
  <div class="max-w-md mx-auto p-6 bg-white shadow-md rounded-md mt-8">
    <div>
      <h2 class="text-xl font-semibold mb-4">商品購入</h2>
      <div class="mb-4"><strong>商品名:</strong> {{ item.name }}</div>
      <div class="mb-4"><strong>価格:</strong> {{ item.price }}</div>

      <!-- 支払方法 -->
      <div class="mt-4">
        <label for="payment" class="block text-sm font-medium text-gray-700"
          >支払方法:</label
        >
        <select
          id="payment"
          v-model="paymentMethod"
          class="mt-1 p-2 border border-gray-300 rounded-md w-full"
        >
          <option value="credit_card">クレジットカード</option>
          <option value="paypal">PayPal</option>
          <option value="bank_transfer">銀行振込</option>
        </select>
      </div>

      <!-- 配送先 -->
      <div class="mt-4">
        <label for="shipping" class="block text-sm font-medium text-gray-700"
          >配送先:</label
        >
        <textarea
          id="shipping"
          v-model="shippingAddress"
          rows="3"
          class="mt-1 p-2 border border-gray-300 rounded-md w-full"
          required
        ></textarea>
      </div>

      <!-- 商品代金 -->
      <div class="mt-4"><strong>商品代金:</strong> {{ item.price }}</div>

      <!-- 総額 -->
      <div class="mt-4"><strong>総額:</strong> {{ totalAmount }}</div>
    </div>

    <!-- 購入ボタン -->
    <button
      @click="confirmPurchase"
      class="block mt-4 bg-blue-500 py-2 px-4 rounded-md text-white text-center"
    >
      購入する
    </button>

    <!-- 戻るボタン -->
    <Link
      href="/item"
      class="block mt-4 bg-gray-300 py-2 px-4 rounded-md text-center"
      >戻る</Link
    >
  </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  item: Object,
  purchasedItems: Object,
  purchasedItemIds: Object,
});


const confirmPurchase = () => {
  
  
    if (confirm("本当に購入しますか？")) {
      purchaseItem(props.item.id);
    }
  
};

const purchaseItem = (id) => {
  console.log(id);
  form.post(route("purchase.purchase", id));
  isPurchased.value = true; // お気に入り状態を反転
  // 削除後のリダイレクトなど、必要な処理を追加することができます
};



const form = useForm({
  comment: "",
});

// // 支払方法と配送先のデータ
// const paymentMethod = ref("credit_card");
// const shippingAddress = ref("");

// // 商品代金と総額の計算
// const totalAmount = ref(item.price);

// // 購入ボタンのクリックイベントハンドラー
// const purchaseItem = () => {
//   // ここで購入処理を行う
//   console.log("購入処理を行います...");
// };
</script>
