<template>
  <Head title="Profile" />

  <section class="">
    <div>
      <ImageUpload />
    </div>
    <div class="tw-py-12">
      <div class="tw-max-w-7xl tw-mx-auto sm:tw-px-6 lg:tw-px-8 tw-space-y-6">
        <div
          class="tw-p-4 sm:tw-p-8 tw-bg-gray-200 tw-shadow sm:tw-rounded-lg"
          :class="theme.isDark && 'tw-bg-gray-900'"
        >
          <UpdateProfileInformationForm
            :must-verify-email="mustVerifyEmail"
            :status="status"
          />
        </div>
        <div
          class="tw-p-4 sm:tw-p-8 tw-bg-gray-200 tw-shadow sm:tw-rounded-lg"
          :class="theme.isDark && 'tw-bg-gray-900'"
        >
          <UpdatePasswordForm class="tw-max-w-xl" />
        </div>
        <div
          class="tw-p-4 sm:tw-p-8 tw-bg-gray-200 tw-shadow sm:tw-rounded-lg"
          :class="theme.isDark && 'tw-bg-gray-900'"
        >
          <DeleteUserForm class="max-w-xl" />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import { useThemeStore } from "@/store/theme";
const theme = useThemeStore();
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
