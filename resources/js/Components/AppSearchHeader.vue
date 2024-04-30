<template>
  <template v-if="sm || $vuetify.display.mdAndUp">
    <aside class="tw-flex tw-gap-3 tw-items-center tw-w-[50%]">
      <div
        class="tw-border tw-relative tw-rounded-xl tw-border-primary-100 tw-overflow-hidden flex-row-center relative tw-ms-[50px] tw-flex-1 tw-mx-auto">
        <label for="search" class="tw-absolute tw-top-1/2 tw-left-2 -tw-translate-y-1/2 tw-cursor-pointer">
          <v-icon>mdi-magnify</v-icon>
        </label>
        <input type="text" id="search" autocomplete="search"
          class="tw-bg-gray-100 tw-w-full tw-ring-0 tw-outline-none tw-block tw-pl-10" placeholder="Search Courses">
      </div>
      <Link v-if="!props.isAuth" href="register?type=teacher" class="tw-text-nowrap tw-text-sm tw-underline">
      Teach on School
      </Link>
    </aside>
  </template>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { useDisplay } from 'vuetify';

const props = defineProps({
  isAuth: Boolean
})

const { sm } = useDisplay();

</script>
