<template>
  <v-card
    v-for="(item, key) in data"
    :key="key"
    class="v__card-popular tw-mx-auto tw-w-full tw-relative tw-min-w-[200px] lg:tw-min-w-[250px] tw-max-w-[280px]"
    :class="`${className} ${theme.isDark && '!tw-bg-gray-900'}`"
  >
    <v-img :src="item.image" cover class="img__height tw-relative">
      <div
        v-if="canDelete"
        class="tw-absolute tw-top-3 tw-left-3 tw-z-10 tw-w-full"
      >
        <CourseCardDots :id="item.id" />
      </div>

      <v-btn
        v-if="!store.checkExisting(item.id) && !canDelete"
        @click="() => handleCartClick(item)"
        class="tw-absolute tw-top-3 tw-left-3 tw-z-10 tw-w-full"
        color="warning"
        icon="mdi-cart"
        variant="flat"
      >
      </v-btn>
    </v-img>

    <v-card-item class="!tw-pb-0">
      <v-card-title
        class="tw-text-ellipsis tw-overflow-x-hidden !tw-text-sm md:!tw-text-base"
      >
        <Link :href="route('course.single', { id: item.id })">
          {{ item.title }}
        </Link>
      </v-card-title>

      <v-card-subtitle class="!tw-b-0">
        <span class="tw-me-1 tw-text-xs md:tw-text-base"
          >By {{ item?.fullname || item.instructor.user.fullname }}</span
        >
      </v-card-subtitle>
    </v-card-item>

    <v-card-text>
      <div class="tw-flex tw-items-center tw-mx-0 tw-gap-4">
        <v-rating
          :model-value="item?.avg_rating"
          color="amber"
          density="compact"
          size="small"
          half-increments
          readonly
        ></v-rating>
        <div
          class="tw-text-grey-400 tw-hidden md:tw-block"
          v-if="item?.avg_rating"
        >
          {{ item?.avg_rating }}|({{ item?.avg_voters }})
        </div>
        <p>{{ item.duration }}hrs</p>
      </div>

      <!-- <div>{{ item.duration }} Total Hours</div> -->
      <p class="tw-font-semibold tw-text-lg">${{ item.price }}</p>
    </v-card-text>
  </v-card>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { useCartStore } from "@/store/cart";
import CourseCardDots from "@/Components/CourseCardDots.vue";
import { useThemeStore } from "@/store/theme";
const store = useCartStore();
const theme = useThemeStore();

const props = defineProps({
  data: Array,
  className: String,
  canDelete: Boolean,
});

function handleCartClick(value) {
  store.addToCart(value);
}

function deleteCourse(id) {
  router.delete(route("course.delete", { id: id }));
}
</script>

<style scoped>
.img__height {
  height: 140px;
}

@media (width>430px) {
  .img__height {
    height: 150px;
  }
}

@media (width>=768px) {
  .img__height {
    height: 160px;
  }
}
</style>