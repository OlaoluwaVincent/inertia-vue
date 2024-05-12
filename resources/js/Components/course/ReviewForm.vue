<template>
  <section
    class="tw-bg-inherit tw-py-10 tw-flex tw-flex-col-reverse tw-gap-8 md:tw-flex-row"
  >
    <aside class="tw-w-full tw-mx-auto tw-max-w-[70%]">
      <form
        class="tw-p-[5%] md:tw-p-[2%] tw-bg-gray-100 tw-h-max"
        :class="theme.isDark && '!tw-bg-gray-900'"
        @submit.prevent="submit"
      >
        <h1 class="tw-mb-5 tw-font-bold">Add Review</h1>
        <p class="tw-pl-3">Select a Rating</p>
        <v-rating
          v-model="rating"
          active-color="orange"
          color="orange-lighten-1"
        ></v-rating>
        <div class="tw-relative">
          <textarea
            name="comment"
            class="tw-w-full tw-h-[150px] tw-bg-white"
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
        <p class="tw-text-red-500" v-show="error">
          {{ error }}
        </p>
      </form>
      <div class="tw-flex tw-gap-3 tw-mt-3" v-if="reviews.length">
        <v-rating
          v-model="average_rating"
          readonly
          density="compact"
          active-color="orange"
          color="orange-lighten-1"
        ></v-rating>
        <p>({{ total_raters }})</p>
      </div>
    </aside>

    <section
      id="reviews"
      v-if="reviews.length"
      class="tw-w-full tw-flex tw-flex-col tw-gap-4"
    >
      <UserReview :reviews="reviews" />
    </section>

    <div v-else>No Reviews yet, Be the first to Leave a Review</div>
  </section>
</template>
<script setup>
import { useThemeStore } from "@/store/theme";
import { computed, onMounted, ref, watch } from "vue";
import UserReview from "./UserReview.vue";

const props = defineProps({
  id: Number,
});

const theme = useThemeStore();

const error = ref(null);
const _reviews = ref([]);
const rating = ref(2);
const isDisabled = ref(true);
const comment = ref("");
const total_raters = ref(0);
const average_rating = ref(0);
watch(comment, () => {
  if (comment.value.length > 5) {
    return (isDisabled.value = false);
  }
  isDisabled.value = true;
});

const reviews = computed(() => _reviews.value);

const submit = async () => {
  try {
    const res = await axios.post("/reviews/" + props.id, {
      rating: rating.value,
      comment: comment.value,
    });
    _reviews.value = res.data;
    if (res.data) {
      comment.value = "";
    }
  } catch (err) {
    error.value = err.response.data.message || err.message;
  }
};

async function getReviews() {
  try {
    const res = await axios.get("/reviews/" + props.id);
    _reviews.value = res.data.reviews;
    total_raters.value = res.data.total_raters;
    average_rating.value = res.data.average_rating;
  } catch (error) {
    console.log(error.message);
  }
}

onMounted(() => {
  return getReviews();
});
</script>


<style scoped>
form {
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
</style>