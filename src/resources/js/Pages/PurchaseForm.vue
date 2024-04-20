<template>
  <div class="max-w-4xl mx-auto flex flex-col md:flex-row mt-8">
    <!-- 左側のフォーム -->
    <div class="w-full md:w-1/2 p-6 bg-white shadow-md rounded-md mb-4 md:mr-4">
      <h2 class="text-xl font-semibold mb-4">商品購入</h2>
      <div class="mb-4">
        <strong>商品名:</strong> {{ item.name }}
      </div>
      <div class="mb-4">
        <strong>価格:</strong> {{ item.price }}
      </div>
      <!-- 支払方法 -->
      <div class="mt-4">
        <label for="payment" class="block text-sm font-medium text-gray-700">支払方法:</label>
        <select v-model="textPayment" id="payment" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
          <option value="クレジットカード">クレジットカード</option>
          <option value="代金引換">代金引換</option>
          <option value="銀行振込">銀行振込</option>
        </select>
      </div>
      <!-- 配送先 -->
      <div class="mt-4">
        <label for="shipping" class="block text-sm font-medium text-gray-700">配送先:</label>
        <select v-model="textShipping" id="shipping" class="mt-1 p-2 border border-gray-300 rounded-md w-full" >
          <option value="自宅">自宅</option>
          <option value="その他">その他</option>
        </select>
      </div>
      <!-- 商品代金 -->
      <div class="mt-4">
        <strong>配送料（全国一律）:</strong> 500円
      </div>
      <!-- 総額 -->
      <div class="mt-4">
        <strong>総額:</strong> {{ parseFloat(item.price) + 500 }}円
      </div>
      <!-- 購入ボタン -->
      <button @click="confirmPurchase" class="block mt-4 bg-blue-500 py-2 px-4 rounded-md text-white text-center">購入する</button>
      <!-- 戻るボタン -->
      <Link href="/item" class="block mt-4 bg-gray-300 py-2 px-4 rounded-md text-center">戻る</Link>
    </div>
    
    <!-- 右側の選択アイテム表示 -->
    <div class="w-full md:w-1/2 p-6 bg-gray-100 shadow-md rounded-md">
      <h2 class="text-xl font-semibold mb-4">選択した商品</h2>
      <div>
        <strong>支払方法:</strong> {{ textPayment }}
      </div>
      <div>
        <strong>配送先:</strong> {{ textShipping }}
      </div>
      <div>
        <strong>総額:</strong>  {{ parseFloat(item.price) + 500 }}円
      </div>
    </div>
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
};

const textPayment = ref('');

const textShipping = ref('');



const form = useForm({
  comment: "",
});



</script>
