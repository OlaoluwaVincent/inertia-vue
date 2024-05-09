<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import LoginRegLinks from '@/Components/LoginRegLinks.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    fullname: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
});


const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <Head title="Create Account" />

    <section
        class="tw-flex md:tw-flex-col lg:tw-flex-row tw-items-center tw-justify-center tw-gap-10 tw-h-full tw-w-full tw-p-10 md:tw-px-[8%] tw-mb-10">
        <div
            class="tw-hidden md:tw-block md:tw-h-[400px] lg:tw-h-auto tw-w-[80%] tw-relative tw-rounded-3xl tw-overflow-hidden">
            <v-img class="bg-grey-lighten-2 tw-h-full tw-w-full " src="/assets/images/regImg.png" cover></v-img>
        </div>
        <aside class="tw-w-full tw-flex tw-flex-col tw-gap-3">
            <h2 class="tw-text-2xl tw-text-center mb-3 sm:mb-0">Nice to have you!</h2>
            <LoginRegLinks />
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="fullname" value="Full Name" />

                    <TextInput id="fullname" type="text" class="mt-1 block w-full" v-model="form.fullname" required
                        autofocus autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.fullname" />
                </div>
                <div class="mt-4">
                    <InputLabel for="username" value="Username" />

                    <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.username" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" required autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="tw-flex tw-items-center tw-justify-center md:tw-justify-end tw-mt-4">
                    <Link :href="route('login')"
                        class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-text-nowrap">
                    Already registered?
                    </Link>

                    <PrimaryButton :disabled="form.processing">Register</PrimaryButton>

                </div>
            </form>
        </aside>
    </section>


</template>
