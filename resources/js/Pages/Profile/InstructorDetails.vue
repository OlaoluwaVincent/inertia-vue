<template>
  <section>
    <h1>Please Fill in your Onboarding Details</h1>

    <section id="form">
      <div class="form__group">
        <label for="headline" class="form__label">Headline</label>
        <div class="form__input-container">
          <input
            type="text"
            id="headline"
            class="form__input"
            v-model="form.headline"
          />
        </div>
        <InputError class="mt-2" :message="form.errors.headline" />
      </div>

      <div class="form__group">
        <label for="professional_experience" class="form__label"
          >Professional Experience</label
        >
        <div class="form__input-container">
          <textarea
            id="professional_experience"
            class="form__input tw-m-0 tw-outline-0 focus:tw-outline-0 tw-h-[150px] tw-bg-white"
            :class="theme.isDark && '!tw-bg-gray-700'"
            v-model="form.professional_experience"
          />
        </div>
        <InputError
          class="mt-2"
          :message="form.errors.professional_experience"
        />
      </div>

      <div class="form__group">
        <label for="professional_experience" class="form__label"
          >Areas of Expertise</label
        >
        <div class="form__input-container">
          <input
            type="text"
            class="form__input"
            @keydown.enter="pressed('expertise')"
            v-model="expertise"
          />
        </div>
        <InputError class="mt-2" :message="form.errors.expertise" />

        <v-list v-if="form.expertise.length" density="compact">
          <v-list-item
            v-for="(item, index) in form.expertise"
            :key="index"
            density="compact"
          >
            <span class="tw-mr-3 tw-cursor-pointer">
              <v-icon color="error" @click="removeItem('expertise', index)"
                >mdi-delete</v-icon
              ></span
            >{{ item }}
          </v-list-item>
        </v-list>
      </div>

      <div class="form__group">
        <label for="professional_experience" class="form__label"
          >Spoken languages</label
        >
        <div class="form__input-container">
          <input
            type="text"
            class="form__input"
            @keydown.enter="pressed('languages')"
            v-model="languages"
          />
        </div>
        <InputError class="mt-2" :message="form.errors.languages" />

        <v-list v-if="form.languages.length" density="compact">
          <v-list-item
            v-for="(item, index) in form.languages"
            :key="index + 1"
            density="compact"
          >
            <span class="tw-mr-3 tw-cursor-pointer">
              <v-icon color="error" @click="removeItem('languages', index)"
                >mdi-delete</v-icon
              ></span
            >{{ item }}
          </v-list-item>
        </v-list>
      </div>
      <v-btn type="submit" color="teal-darken-3" @click="submit">{{
        isOnBoard ? "Update Details" : "Save"
      }}</v-btn>
    </section>

    <InstructorSnackbar v-model="snackbar">
      {{ isOnBoard ? "Updated" : "Saved" }} Succesfully
    </InstructorSnackbar>
  </section>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import { useThemeStore } from "@/store/theme";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import InstructorSnackbar from "@/Components/SnackBar.vue";
import { keyPressed, deleteItem } from "@/composable/instructorComposable";
defineOptions({ layout: UserLayout });

const theme = useThemeStore();
const props = defineProps({
  isOnBoard: Boolean,
  details: Object,
  errors: Object,
  auth: Object,
});

const form = useForm({
  headline: props.details?.headline ?? "",
  professional_experience: props.details?.professional_experience ?? "",
  expertise: props.details?.expertise || [],
  languages: props.details?.languages || [],
});

const expertise = ref("");
const languages = ref("");
const snackbar = ref(false);

function pressed(type) {
  keyPressed(type, languages, form, expertise);
}

function removeItem(type, itemId) {
  deleteItem(type, itemId, form);
}

const submit = () => {
  if (props.isOnBoard) {
    return form.submit(
      "patch",
      route("userDetails.edit", { instructor: props.auth.user.instructor_id }),
      {
        onSuccess: () => {
          snackbar.value = true;
        },
      }
    );
  }
  form.post(route("userDetails.store"), {
    onSuccess: () => {
      snackbar.value = true;
    },
  });
};
</script>

<style scoped>
#form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form__group {
  display: flex;
  gap: 6px;
  flex-direction: column;
}

.form__label {
  font-size: 18px;
  font-weight: 500;
}

.form__input-container {
  @apply tw-border tw-border-primary-100 tw-rounded-md tw-overflow-hidden;
}

.form__input {
  width: 100%;
}
</style>
