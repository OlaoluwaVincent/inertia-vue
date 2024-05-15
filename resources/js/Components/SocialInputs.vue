<template>
  <div class="container">
    <aside>
      <h4 class="tw-mb-3">Social Handles</h4>
      <v-btn
        type="submit"
        @click="submitForm"
        color="teal-lighten-1"
        class="!tw-text-center"
        >Upload</v-btn
      >

      <div class="social__wrapper">
        <div
          v-for="social in socialMedia"
          :key="social.handle"
          class="tw-flex tw-flex-col tw-gap-3 social__item"
        >
          <v-text-field
            v-model="social.link.value"
            :label="social.handle"
            dense
            :rules="social.rules"
            @input="validateLink(social)"
          ></v-text-field>
        </div>
      </div>
    </aside>
    <p v-if="message.length" class="tw-text-red-600 tw-font-bold">
      {{ message }}
    </p>
  </div>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const socialsFromDB = computed(() => usePage().props.auth.user.socials);

const socialMedia = [
  {
    handle: "Website",
    link: ref(""),
    rules: [
      (value) =>
        value.length <= 2 || isValidLink(value) || "Invalid link format",
    ],
  },
  {
    handle: "X",
    link: ref(""),
    rules: [
      (value) =>
        value.length <= 2 || isValidLink(value) || "Invalid link format",
    ],
  },
  {
    handle: "LinkedIn",
    link: ref(""),
    rules: [
      (value) =>
        value.length <= 2 || isValidLink(value) || "Invalid link format",
    ],
  },
];

// Prefill inputs if the handle matches data from the database
socialMedia.forEach((social) => {
  const matchingSocial = socialsFromDB.value.find(
    (dbSocial) => dbSocial.handle === social.handle
  );
  if (matchingSocial) {
    social.link.value = matchingSocial.link;
  }
});

function isValidLink(link) {
  const urlRegex = /^(ftp|http|https):\/\/[^ "]+$/;
  return urlRegex.test(link);
}

function validateLink(social) {
  social.rules.forEach((rule) => {
    if (!rule(social.link)) {
      social.link = "";
    }
  });
}

const form = useForm({
  socials: null,
});

const message = ref("");

function submitForm() {
  const socials = [];

  socialMedia.forEach((social) => {
    if (social.link.value && social.link.value.length > 2) {
      socials.push({ handle: social.handle, link: social.link.value });
    }
  });

  if (!socials.length) {
    return (message.value = "For your mind you wise");
  }

  form.socials = socials;

  form.post("profile", {
    onSuccess: () => {
      message.value = "Successful";
    },
    onError: () => {
      message.value = "Successful";
    },
  });
}
</script>

<style scoped>
.container {
  container-type: inline-size;
  container-name: social_wrapper;
}

.social__wrapper {
  @apply tw-flex tw-flex-col tw-gap-3;
}

.social__item {
  width: 100%;
}

@container (min-width: 600px) {
  .social__wrapper {
    @apply tw-flex-row tw-gap-2 tw-justify-between;
  }
  .social__item {
    width: 100%;
    min-width: 200px;
  }
}
</style>
