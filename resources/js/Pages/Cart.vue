<template>
  <Head title="Cart" />
  <section id="cart" class="tw-mb-52 tw-p-5">
    <aside class="tw-flex tw-flex-col tw-gap-5 tw-flex-shrink-0 md:tw-w-[60%]">
      <h6 class="tw-font-semibold">
        {{ cartStore.cartLength }} Course in Cart
      </h6>
      <v-divider
        :thickness="5"
        class="!tw-opacity-50 !tw-border-blue-500"
      ></v-divider>

      <CartCard
        v-for="course in cartStore.cart"
        :key="course.id"
        :course="course"
      />
    </aside>

    <aside class="tw-flex tw-flex-col tw-gap-5 md:tw-w-[40%]">
      <h6 class="tw-font-semibold">Order Details</h6>
      <v-divider
        :thickness="5"
        class="!tw-opacity-50 !tw-border-blue-500"
      ></v-divider>
      <OrderDetails />
    </aside>
  </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import CartCard from "@/Components/cart/CartCard.vue";
import OrderDetails from "@/Components/cart/OrderDetails.vue";

import { useCartStore } from "@/store/cart";

const cartStore = useCartStore();
</script>

<style scoped>
#cart {
  display: flex;
  flex-direction: column;
  width: 100%;
  gap: 20px;
}

@media (width>=768px) {
  #cart {
    flex-direction: row;
  }
}
</style>