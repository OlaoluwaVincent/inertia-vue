<template>
  <section class="tw-mb-10 content__padding tw-flex tw-flex-col tw-gap-5">
    <h1>Add Lesson</h1>

    <div>
      <InputLabel for="title" value="Lesson Title" />

      <TextInput
        id="title"
        type="text"
        class="mt-1 block w-full !tw-rounded-md"
        v-model="form.title"
        required
        autocomplete="title"
      />

      <InputError class="mt-2" :message="form.errors.title" />
    </div>

    <SelectList
      v-model="form.course_id"
      :listError="form.errors.course_id"
      :lists="course_list"
    />
    <TextDescription
      v-model:description="form.description"
      :descriptionError="form.errors.description"
    />

    <UploadVideo :videoError="form.errors.video" @get-video-url="getVideoUrl" />

    <v-btn
      block
      color="teal-darken-4"
      :disabled="form.processing"
      @click="submit"
      >{{ form.processing ? "Submitting" : "Submit" }}
      <span
        v-if="form.processing"
        class="tw-flex tw-items-center tw-justify-between tw-bg-white tw-text-yellow-600 tw-p-2 tw-rounded-full tw-text-xs tw-ml-5"
        >{{ form.processing ? form.progress.percentage : "" }}</span
      ></v-btn
    >
  </section>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import SelectList from "@/Components/SelectList.vue";
import TextDescription from "@/Components/TextDescription.vue";
import UploadVideo from "@/Components/UploadVideo.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

defineOptions({ layout: UserLayout });
const props = defineProps({
  courses: Array,
  auth: Object,
  errors: Object,
  query: String,
  lesson: Object,
});

console.log(props.lesson);

const course_list = computed(() => {
  return props.courses.map((course) => ({
    title: course.title,
    value: course.id,
  }));
});

const form = useForm({
  title: "",
  course_id: Number(props.query) || "",
  description: "",
  video: "",
});

function getVideoUrl(videoFile) {
  form.video = videoFile;
}

function submit() {
  form.submit("post", route("lesson.store"), {
    onSuccess: () => {
      form.reset();
    },
  });
}
</script>

<style script>
</style>