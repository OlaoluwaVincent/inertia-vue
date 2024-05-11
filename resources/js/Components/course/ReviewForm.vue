<template>
  <section class="tw-bg-slate-300 tw-py-10">
    <h1>Add Review</h1>
    <form class="tw-w-full tw-px-[5%]" @submit.prevent="submit">
      <v-rating
        v-model="rating"
        active-color="orange"
        color="orange-lighten-1"
        name="rating"
      ></v-rating>
      <div class="tw-relative">
        <textarea
          name="comment"
          class="tw-w-full tw-h-[200px] tw-bg-white"
          placeholder="Leave a Review..."
          required
          v-model="comment"
        />
        <button
          type="submit"
          :disabled="isDisabled"
          class="!tw-absolute tw-right-3 tw-bottom-5 tw-bg-gray-300 !tw-block !tw-p-2 tw-rounded-md hover:tw-bg-gray-200"
        >
          <v-icon
            class="tw-text-blue-700 tw-text-2xl"
            :class="isDisabled && 'tw-text-gray-400'"
            >mdi-send</v-icon
          >
        </button>
      </div>
      <p class="tw-text-red-500" v-show="errors">
        {{ errors.comment || errors.rating || message }}
      </p>
    </form>
  </section>
</template>

<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";

const page = usePage();
const message = computed(() => page.props.message);
const props = defineProps({
  id: Number,
  errors: Object,
});

const rating = ref(2);
const isDisabled = ref(true);
const comment = ref("");

watch(comment, () => {
  if (comment.value.length > 5) {
    return (isDisabled.value = false);
  }
  isDisabled.value = true;
});

const submit = () => {
  router.post("/reviews/" + props.id, {
    rating: rating.value,
    comment: comment.value,
  });
};
</script>

<style>
</style>