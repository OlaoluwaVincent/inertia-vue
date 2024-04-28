<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <nav
    class="tw-flex tw-gap-4 tw-rounded-full tw-items-center tw-justify-center tw-bg-primary-70 tw-text-white tw-p-2 tw-w-fit tw-mx-auto">
    <Link :href="route('login')" class="tw-text-center tw-px-4 md:tw-px-12 tw-py-2 tw-rounded-full"
      :class="{ 'tw-bg-primary-100': $page.url === '/login' }">Login</Link>
    <Link :href="route('register')" class="tw-text-center tw-px-4 md:tw-px-12 tw-py-2 tw-rounded-full"
      :class="{ 'tw-bg-primary-100': $page.url === '/register' }">Register</Link>
  </nav>
</template>