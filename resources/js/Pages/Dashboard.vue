<script setup>
import { Head, Link } from '@inertiajs/vue3';

function logout() {
    route('logout')
}
</script>

<template>

    <Head title="Dashboard" />

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>


    <div class="py-12">
        <Link :href="route('logout')" method="post" as="button"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Log Out</Link>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">You're logged in!</div>
            </div>
        </div>
    </div>
</template>
