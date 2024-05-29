<template>
  <form
    class="tw-bg-gray-300 tw-flex tw-flex-col tw-gap-5 tw-w-full tw-p-4 tw-rounded-md"
    :class="theme.isDark && 'tw-bg-gray-900'"
    @submit.prevent="form.post('/pay')"
  >
    <p>
      Price: <span>{{ cartStore.price }}</span>
    </p>
    <p>
      Discount: <span>{{ cartStore.discount }}</span>
    </p>
    <p>
      Tax: <span v-if="cartStore.tax !== NaN">{{ cartStore.tax }}</span>
    </p>

    <v-divider class="tw-border-gray-600"></v-divider>
    <p class="tw-text-lg tw-uppercase tw-font-bold">
      Total:
      <span v-if="total !== NaN">{{ total }}</span>
    </p>
    <v-btn color="black" type="submit" :disabled="!cartStore.price"
      >Proceed to Checkout</v-btn
    >
    <!-- </Link> -->
  </form>
</template>

<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import { useCartStore } from "@/store/cart";
import { useThemeStore } from "@/store/theme";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user);
const theme = useThemeStore();
const cartStore = useCartStore();

const total = computed(() =>
  (
    parseFloat(cartStore.price) +
    parseFloat(cartStore.tax) +
    parseFloat(cartStore.discount)
  ).toFixed(2)
);

const form = useForm({
  amount: total.value,
  metadata: cartStore.cart.map((item) => ({
    id: item.id,
    title: item.title,
  })),
});
</script>

<style scoped>
p {
  display: flex;
  justify-content: space-between;
}
</style>
