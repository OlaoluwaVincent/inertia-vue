<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
  password: "",
});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;

  nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
  form.delete(route("profile.destroy"), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;

  form.reset();
};
</script>

<template>
  <section class="tw-space-y-6">
    <header>
      <h2 class="tw-text-lg tw-font-medium">Delete Account</h2>

      <p class="tw-mt-1 tw-text-sm">
        Once your account is deleted, all of its resources and data will be
        permanently deleted. Before deleting your account, please download any
        data or information that you wish to retain.
      </p>
    </header>

    <v-btn class="tw-ms-3" tile color="error" @click="confirmUserDeletion">
      Delete Account
    </v-btn>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
      <div class="tw-p-6">
        <h2 class="tw-text-lg tw-font-medium">
          Are you sure you want to delete your account?
        </h2>

        <p class="tw-mt-1 tw-text-sm">
          Once your account is deleted, all of its resources and data will be
          permanently deleted. Please enter your password to confirm you would
          like to permanently delete your account.
        </p>

        <div class="tw-mt-6">
          <InputLabel for="password" value="Password" class="sr-only" />

          <TextInput
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="tw-mt-1 tw-block tw-w-3/4"
            placeholder="Password"
            @keyup.enter="deleteUser"
          />

          <InputError :message="form.errors.password" class="tw-mt-2" />
        </div>

        <div class="tw-mt-6 tw-flex tw-justify-end">
          <v-btn variant="outlined" tile color="" @click="closeModal">
            Cancel
          </v-btn>
          <v-btn
            class="tw-ms-3"
            tile
            color="error"
            @click="deleteUser"
            :class="{ 'tw-opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Account
          </v-btn>
        </div>
      </div>
    </Modal>
  </section>
</template>
