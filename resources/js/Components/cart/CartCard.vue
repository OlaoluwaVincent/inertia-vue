<template>
  <section class="cart__card" :class="theme.isDark && 'tw-bg-gray-900'">
    <div class="tw-flex tw-flex-col">
      <v-img
        class="cart__image"
        aspect-ratio="16/9"
        cover
        rounded
        :src="course.image"
      ></v-img>
      <div class="tw-font-bold md:tw-hidden">${{ course.price }}</div>
    </div>

    <div class="cart__info">
      <h3>{{ course.title }}</h3>
      <h5>By {{ course.instructor.name }}</h5>

      <div class="cart__info--time">
        <p class="tw-text-xs sm:tw-text-sm">
          {{ course.duration }} Total Hours
        </p>
        <p v-if="course.lessons" class="tw-text-xs sm:tw-text-sm">
          {{ course.lessons.length }} Lectures
        </p>
      </div>

      <div class="cart__actions">
        <!-- <v-btn
          color="info"
          variant="text"
          class="!tw-capitalize !tw-text-xs md:!tw-text-sm"
          >Save</v-btn
        > -->
        <v-btn
          color="error"
          variant="text"
          @click="cartStore.removeFromCart(course.id)"
          class="!tw-capitalize !tw-text-xs md:!tw-text-sm"
          >Remove</v-btn
        >
      </div>
    </div>
    <div class="cart__price">${{ course.price }}</div>
  </section>
</template>

<script setup>
import { useCartStore } from "@/store/cart";
import { useThemeStore } from "@/store/theme";

const theme = useThemeStore();
const cartStore = useCartStore();
const props = defineProps({
  course: Object,
});
</script>

<style scoped>
.cart__card {
  display: flex;
  width: 100%;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  padding: 12px;
}

.cart__image {
  width: 80px;
}

.cart__info {
  margin-left: 12px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  flex: 1;
}

.cart__info h3 {
  font-weight: bold;
  font-size: 18px;
}

.cart__info h5 {
  font-size: 14px;
  font-weight: 500;
  @apply tw-text-gray-500;
}

.cart__info--time {
  display: flex;
  gap: 18px;
}

.cart__actions {
  display: flex;
  gap: 8px;
  margin-left: -8px;
}

.cart__price {
  font-weight: bold;
  justify-self: flex-end;
  padding-right: 20px;
  display: none;
}

@media (width>=768px) {
  .cart__image {
    width: 100px;
    max-width: 150px;
  }

  .cart__price {
    display: block;
  }
}

@media (width>=1024px) {
  .cart__image {
    width: 200px;
  }
}
</style>