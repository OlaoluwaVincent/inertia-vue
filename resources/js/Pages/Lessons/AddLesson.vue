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

    <UploadVideo
      :videoError="form.errors.video"
      @get-video-url="getVideoUrl"
      :preview="lessons?.video_url"
    />

    <v-btn
      v-if="onEdit"
      block
      color="blue-darken-4"
      :disabled="form.processing"
      @click="submit"
      >{{ form.processing ? "Updating" : "Update" }}
      <span
        v-if="form.processing"
        class="tw-flex tw-items-center tw-justify-between tw-bg-white tw-text-yellow-600 tw-p-2 tw-rounded-full tw-text-xs tw-ml-5"
        >{{ form?.processing ? form?.progress?.percentage : "" }}</span
      ></v-btn
    >
    <v-btn
      v-else
      block
      color="teal-darken-4"
      :disabled="form.processing"
      @click="submit"
      >{{ form.processing ? "Submitting" : "Submit" }}
      <span
        v-if="form.processing"
        class="tw-flex tw-items-center tw-justify-between tw-bg-white tw-text-yellow-600 tw-p-2 tw-rounded-full tw-text-xs tw-ml-5"
        >{{ form?.processing ? form?.progress?.percentage : "" }}</span
      ></v-btn
    >
  </section>
</template>

<script setup>
import { router, useForm } from "@inertiajs/vue3";
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
  courses_snippet: Array,
  auth: Object,
  errors: Object,
  course_query: String,
  lessons: Object,
});

const course_list = computed(() => {
  return props.courses_snippet.map((course) => ({
    title: course.title,
    value: course.id,
  }));
});

const onEdit = computed(() => (props.lessons ? true : false));

const form = useForm({
  title: props.lessons?.title ?? "",
  course_id: props.lessons?.course_id ?? Number(props.course_query),
  description: props.lessons?.description ?? "",
  video: "",
});

function getVideoUrl(videoFile) {
  form.video = videoFile;
}

function submit() {
  if (onEdit) {
    form.submit(
      "post",
      route("lesson.update", {
        course: props.lessons.course_id,
        lesson: props.lessons.id,
      }),
      {
        onSuccess: () => {
          form.reset();
          router.visit(
            route("lesson.index", { course: Number(props.course_query) })
          );
        },
      }
    );
    return;
  }
  form.submit("post", route("lesson.store"), {
    onSuccess: () => {
      form.reset();
      router.visit(
        route("lesson.index", { course: Number(props.course_query) })
      );
    },
  });
}
</script>

<style script>
</style>