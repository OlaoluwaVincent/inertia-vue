<template>
  <Head title="Checkout Form" />
  <section id="cart" class="tw-mb-52 tw-p-5">
    <aside
      class="tw-flex tw-flex-col tw-gap-5 tw-flex-shrink-0 lg:tw-w-[70%] xl:tw-w-[60%]"
    >
      <CheckoutForm />
    </aside>

    <aside class="tw-flex tw-flex-col tw-gap-5 tw-w-full md:tw-w-max">
      <OrderDetails />
    </aside>
  </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import CheckoutForm from "@/Components/checkout/CheckoutForm.vue";
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