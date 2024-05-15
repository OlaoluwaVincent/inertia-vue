<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";
import ImageUpload from "@/Components/ImageUpload.vue";
import SocialInputs from '@/Components/SocialInputs.vue'
import { ref } from "vue";

defineOptions({
  layout: UserLayout,
});

defineProps({
  mustVerifyEmail: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});
</script>

<template>
  <Head title="Profile" />
<div>
  <ImageUpload/>
  <SocialInputs/>
</div>
  <section class="">
    <div class="tw-py-12">
      <div class="tw-max-w-7xl tw-mx-auto sm:tw-px-6 lg:tw-px-8 tw-space-y-6">
        <div class="tw-p-4 sm:tw-p-8 tw-bg-gray-200 tw-shadow sm:tw-rounded-lg">
          <UpdateProfileInformationForm
            :must-verify-email="mustVerifyEmail"
            :status="status"
            class="tw-max-w-xl"
          />
        </div>
        <div class="tw-p-4 sm:tw-p-8 tw-bg-gray-200 tw-shadow sm:tw-rounded-lg">
          <UpdatePasswordForm class="tw-max-w-xl" />
        </div>
        <div class="tw-p-4 sm:tw-p-8 tw-bg-gray-200 tw-shadow sm:tw-rounded-lg">
          <DeleteUserForm class="max-w-xl" />
        </div>
      </div>
    </div>
  </section>
</template>



