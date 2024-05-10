<template>
  <section
    class="tw-bg-gray-300 tw-flex tw-flex-col tw-gap-5 tw-w-full tw-p-4 tw-rounded-md"
    :class="theme.isDark && '!tw-bg-gray-900'"
  >
    <p>
      Price: <span>{{ cartStore.price }}</span>
    </p>
    <p>
      Discount: <span>{{ cartStore.discount }}</span>
    </p>
    <p>
      Tax: <span>{{ cartStore.tax }}</span>
    </p>

    <v-divider class="tw-border-gray-600"></v-divider>
    <p class="tw-text-lg tw-uppercase tw-font-bold">
      Total:
      <span>{{
        (
          parseFloat(cartStore.price) +
          parseFloat(cartStore.tax) +
          parseFloat(cartStore.discount)
        ).toFixed(2)
      }}</span>
    </p>

    <v-btn color="black">Proceed to Checkout</v-btn>
  </section>
</template>

<script setup>
import { useCartStore } from "@/store/cart";
import { useThemeStore } from "@/store/theme";

const theme = useThemeStore();
const cartStore = useCartStore();
</script>

<style scoped>
p {
  display: flex;
  justify-content: space-between;
}
</style>