<template>
  <v-app-bar class="md:tw-px-10 tw-py-2" density="comfortable">
    <v-app-bar-nav-icon
      variant="text"
      @click.stop="drawer = !drawer"
    ></v-app-bar-nav-icon>

    <aside id="LOGO" class="flex-row-center tw-gap-10">
      <v-toolbar-title>
        <Link href="/">School</Link>
      </v-toolbar-title>

      <aside class="filter">
        <CoursesFilter />
      </aside>
    </aside>

    <v-spacer></v-spacer>
    <!-- Show on small screen -->

<!--    <AppSearchHeader />-->

    <v-spacer></v-spacer>
    <!-- Show on small screen -->
    <aside class="tw-flex tw-items-center">
      <v-btn
        v-if="!$vuetify.display.xs && isAuth"
        icon="mdi-bell"
        variant="text"
        color="orange-darken-2"
      ></v-btn>

      <Link :href="route('cart')">
        <v-btn class="text-none" stacked>
          <v-badge color="error" :content="cartStore.cartLength">
            <v-icon>mdi-cart</v-icon>
          </v-badge>
        </v-btn>
      </Link>
    </aside>
    <AppHeaderAuthBtn v-if="$vuetify.display.mdAndUp" :isAuth="isAuth" />

    <!-- <v-spacer></v-spacer> -->

    <div class="tw-hidden sm:tw-flex tw-mx-3">
      <v-avatar
        v-if="isAuth"
        :image="
          user.profile_picture ||
          `https://via.placeholder.com/640x480.png/001155?text=${user?.email}`
        "
      ></v-avatar>
    </div>

    <AppMenuDots v-if="isAuth" class="tw-mr-5" />
  </v-app-bar>

  <AppSidebar v-model="drawer" />
</template>

<script setup>
import AppSidebar from "@/Components/AppSidebar.vue";
import AppMenuDots from "@/Components/AppMenuDots.vue";
import AppHeaderAuthBtn from "@/Components/AppHeaderAuthBtn.vue";
import CoursesFilter from "@/Components/CoursesFilter.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";
import { useCartStore } from "@/store/cart";

const cartStore = useCartStore();

const userData = usePage();
const isAuth = computed(() => (!!userData.props?.auth?.user?.id));
const user = computed(() => userData.props.auth.user ?? null);

const drawer = ref(false);
const group = ref(null);

watch(group, () => {
  drawer.value = false;
});
</script>


<style scoped>
.flex-row-center {
  @apply tw-flex tw-items-center tw-justify-center;
}
</style>
