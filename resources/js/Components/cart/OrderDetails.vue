<template>
  <section
    class="tw-bg-gray-300 tw-flex tw-flex-col tw-gap-5 tw-w-full tw-p-4 tw-rounded-md"
    :class="theme.isDark && 'tw-bg-gray-900'"
  >
    <p>
      Price: <span>{{ cartStore.price }}</span>
    </p>
    <p>
      Discount: <span>{{ cartStore.discount }}</span>
    </p>
    <p>
      Tax: <span v-if="typeof total == 'number'">{{ cartStore.tax }}</span>
    </p>

    <v-divider class="tw-border-gray-600"></v-divider>
    <p class="tw-text-lg tw-uppercase tw-font-bold">
      Total:
      <span v-if="typeof total == 'number'">{{ total }}</span>
    </p>
    <v-btn color="black" @click="proceedToCheckout" :disabled="!cartStore.price"
      >Proceed to Checkout</v-btn
    >
    <!-- </Link> -->
  </section>
</template>

<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
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

// Function to handle button click
const proceedToCheckout = () => {
  if (!user.value) {
    return router.visit("/login", { method: "get" });
  } else {
    const amount = total.value;
    router.post("pay", { amount });
  }
};
</script>

<style scoped>
p {
  display: flex;
  justify-content: space-between;
}
</style>
