<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import LoginRegLinks from '@/Components/LoginRegLinks.vue';
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
    <section class="container">
        <div class="img-wrapper">
            <v-img class="bg-grey-lighten-2" src="/assets/images/loginImg.png" cover></v-img>
        </div>


        <section class="w-full flex flex-shrink-1 flex-col gap-3">
            <h2 class="text-sm md:text-2xl text-center">Welcome to School</h2>
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
                <div class="flex items-center justify-end mt-4">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Forgot your password?
                    </Link>
                    <VBtn type="submit" class="text-none ms-4 text-white" color="blue-darken-4" rounded="0"
                        variant="elevated" :disabled="form.processing" slim density="comfortable">
                        Login
                    </VBtn>
                </div>
            </form>
        </section>
    </section>
</template>


<style scoped>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 40px;
    padding: 40px;
}



.img-wrapper {
    display: none;
}

@media (width >=768px) {
    .container {
        padding: 8%
    }
}


@media (width>768px) {
    .img-wrapper {
        display: block;
        width: 100%;
        /* max-width: 600px; */
    }
}
</style>