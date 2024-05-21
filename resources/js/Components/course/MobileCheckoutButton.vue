<template>
  <div
    class="tw-flex md:tw-hidden tw-flex-col tw-gap-5 tw-mt-5 tw-mx-auto tw-w-[80%]"
  >
    <v-btn
      v-if="isExistInCart"
      block
      density="default"
      @click="removeFromCart"
      :class="theme.isDark ? 'light' : 'dark'"
      >Remove From Cart</v-btn
    >

    <v-btn
      v-else
      block
      density="default"
      @click="addToCart"
      :class="theme.isDark ? 'light' : 'dark'"
      >Add To Cart</v-btn
    >

    <v-btn block density="default" :class="theme.isDark ? 'dark' : 'light'"
      >Buy Now</v-btn
    >
    <CartSnackBar v-model="snackbar" />
  </div>
</template>

<script setup>
import { useCartStore } from "@/store/cart";
import { useThemeStore } from "@/store/theme";
import CartSnackBar from "@/Components/SnackBar.vue";
import { computed } from "vue";
const theme = useThemeStore();
const cartStore = useCartStore();

const props = defineProps({
  course: Object,
});

const snackbar = defineModel("snackbar");

const isExistInCart = computed(() => cartStore.checkExisting(props.course.id));

function addToCart() {
  cartStore.addToCart(props.course);
  snackbar.value = true;
}

function removeFromCart() {
  cartStore.removeFromCart(props.course.id);
}
</script>


<style scoped>
.dark {
  background: #222;
  color: white;
}

.light {
  background: white;
  color: #222;
  border: 1px solid #222;
}
</style>