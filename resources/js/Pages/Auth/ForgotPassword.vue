<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <section class="tw-p-10 tw-flex tw-items-center tw-justify-center tw-flex-col tw-h-full tw-w-full">

        <Head title="Forgot Password" />

        <div class="tw-mb-4 tw-text-sm tw-text-gray-600 tw-text-wrap md:tw-w-[40%] tw-text-center">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="tw-mb-4 tw-font-medium tw-text-sm tw-text-green-600">
            {{ status }}
        </div>


        <form @submit.prevent="submit" class="mt-4">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="tw-mt-2 tw-block tw-w-full" v-model="form.email" required
                    autofocus autocomplete="username" />

                <InputError class="tw-mt-2" :message="form.errors.email" />
            </div>

            <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                <PrimaryButton :class="{ 'tw-opacity-25': form.processing }" :disabled="form.processing" :block="true">
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </section>
</template>
