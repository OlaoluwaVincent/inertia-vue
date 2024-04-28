<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import LoginRegLinks from '@/Components/LoginRegLinks.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Welcome to School" />
    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>
    <section
        class="tw-flex md:tw-flex-col lg:tw-flex-row tw-items-center tw-justify-center tw-gap-10 tw-h-full tw-w-full tw-p-10 md:tw-px-[8%]">
        <div
            class="tw-hidden md:tw-block md:tw-h-[400px] lg:tw-h-auto tw-w-[80%] tw-relative tw-rounded-3xl tw-overflow-hidden">
            <v-img class="bg-grey-lighten-2" src="/assets/images/loginImg.png" cover></v-img>
        </div>


        <aside class="tw-w-full tw-flex tw-flex-col tw-gap-3">
            <h2 class="tw-text-2xl tw-text-center mb-3 sm:mb-0">Welcome to School</h2>
            <LoginRegLinks />
            <p class="text-center">This is a random introductory text</p>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                        autocomplete="username" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="current-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>
                <div class="tw-flex tw-items-center tw-justify-center md:tw-justify-end tw-mt-4">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-text-nowrap">
                    Forgot your password?
                    </Link>
                    <PrimaryButton :disabled="form.processing">Login</PrimaryButton>
                </div>
            </form>
        </aside>
    </section>
</template>
