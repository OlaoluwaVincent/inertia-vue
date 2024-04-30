<template>

 <v-navigation-drawer v-model="model" location="left" temporary>
  <div class="tw-flex tw-flex-col tw-gap-3 tw-py-5 tw-justify-between tw-h-full">
   <div class='tw-w-full'>
    <Link v-for="(item, key) in items" :key="key" :href="item.value"
     class="tw-block tw-p-3 hover:tw-bg-blue-700/70 hover:tw-text-white">
    {{ item.title }}
    </Link>
   </div>

   <div v-if="!isAuth" class="tw-flex tw-flex-col tw-gap-3 tw-text-center">
    <Link href="/login"> <v-btn variant="outlined" tile color="gray-darken-4 tw-w-[80%]" text='Login' to="/login" />
    </Link>
    <Link href="/register"> <v-btn variant="flat" border tile color="grey-darken-4 tw-w-[80%]" text='Register'
     to="/register" />
    </Link>
   </div>

  </div>
 </v-navigation-drawer>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue';
const userData = usePage()
const isAuth = computed(() => userData.props?.auth?.user?.id ? true : false)
const items = [
 {
  title: 'Dashboard',
  value: 'dashboard',
 },
 {
  title: 'Courses',
  value: 'courses',
 },
 {
  title: 'Enrolled Courses',
  value: 'enrolled-courses',
 },
];

const model = defineModel()
</script>