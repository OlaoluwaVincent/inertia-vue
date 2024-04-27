<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
 <nav class="flex gap-4 rounded-full items-center justify-center bg-primary-70 text-white p-2 w-fit mx-auto">
  <Link :href="route('login')" class="text-center px-8 md:px-12 py-2 rounded-full"
   :class="{ 'bg-primary-100': $page.url === '/login' }">Login</Link>
  <Link :href="route('register')" class="text-center px-8 md:px-12 py-2 rounded-full"
   :class="{ 'bg-primary-100': $page.url === '/register' }">Register</Link>
 </nav>
</template>