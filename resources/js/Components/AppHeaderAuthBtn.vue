<template>

 <div v-if="!props.isAuth" class="flex-row-center tw-gap-5 mr-5">
  <Link href="/login"> <v-btn variant="outlined" tile color="gray-darken-4" text='Login' to="/login" />
  </Link>
  <Link href="/register"> <v-btn variant="flat" border tile color="grey-darken-4" text='Register' to="/register" />
  </Link>
 </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
 isAuth: {
  type: Boolean,
  required: true,
 }
})

</script>