<template>
  <section class="content__padding tw-mb-5 tw-gap-8">
    <h1 class="tw-font-semibold tw-text-lg">ADD A COURSE</h1>
    <section>
      <div class="mt-4">
        <InputLabel for="title" value="Course Title" />

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

      <div class="">
        <label for="description" class="form__label">Description</label>
        <div class="tw-border !tw-border-teal-700">
          <textarea
            id="description"
            class="!tw-m-0 tw-outline-0 focus:tw-outline-0 tw-h-[150px] tw-bg-white tw-w-full"
            :class="theme.isDark && '!tw-bg-gray-700'"
            v-model="form.description"
          />
        </div>
        <InputError class="mt-2" :message="form.errors.description" />
      </div>

      <section
        class="tw-flex tw-flex-col-reverse md:tw-flex-row tw-gap-4 md:tw-gap-6 tw-items-center tw-justify-between"
      >
        <aside class="tw-flex-1">
          <div class="mt-4">
            <InputLabel for="price" value="Price" />

            <TextInput
              id="price"
              type="number"
              min="1"
              class="mt-1 block w-full !tw-rounded-md"
              v-model="form.price"
              required
              autocomplete="price"
            />

            <InputError class="mt-2" :message="form.errors.price" />
          </div>
          <div class="mt-4">
            <InputLabel for="duration" value="Estimated Duration" />

            <TextInput
              id="duration"
              type="number"
              min="1"
              class="mt-1 block w-full !tw-rounded-md"
              v-model="form.duration"
              required
              autocomplete="duration"
            />

            <InputError class="mt-2" :message="form.errors.duration" />
          </div>

          <div>
            <v-select
              v-model="form.category_id"
              :items="categories"
              hint="Pick a Category"
              label="Select Category"
              class="tw-mt-4"
            ></v-select>
            <InputError class="tw-mt-2" :message="form.errors.category_id" />
          </div>
        </aside>
        <aside>
          <v-file-input
            id="file"
            v-model="form.image"
            accept="image/*"
            @change="previewImage"
            outlined
            required
            prepend-icon="mdi-camera"
            class="d-none"
          ></v-file-input>
          <label for="file" class="tw-mx-auto tw-mt-4">
            <v-avatar
              color="surface-variant"
              :size="200"
              icon="mdi-camera"
              :rounded="false"
              :image="previewUrl"
            ></v-avatar>
          </label>
          <InputError class="tw-mt-2" :message="form.errors.image" />
        </aside>
      </section>

      <div class="tw-flex tw-flex-col tw-gap-6 tw-mt-4">
        <CustomInputSelect
          v-model="objective"
          label="List out Course Objectives"
          :formValue="form.objective"
          :formError="form.errors.objective"
          @delete="
            (index) => (form.objective = deleteOne(index, form.objective))
          "
        />

        <CustomInputSelect
          v-model="requirement"
          label="Pre-requisite for this Course"
          :formValue="form.requirement"
          :formError="form.errors.requirement"
          @delete="
            (index) => (form.requirement = deleteOne(index, form.requirement))
          "
        />
      </div>

      <v-btn color="teal-darken-4" block class="tw-mt-10" @click="submit">{{
        form.processing ? "Processing" : "Save"
      }}</v-btn>
    </section>
  </section>
</template>

<script  setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import CustomInputSelect from "@/Components/CustomInputSelect.vue";
import { useThemeStore } from "@/store/theme";
import { onMounted, ref } from "vue";
import axios from "axios";
import { deleteOne } from "@/composable/instructorComposable";
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });
const props = defineProps({
  course: Object,
});

onMounted(() => getCategories());

const categories = ref([]);

async function getCategories() {
  try {
    const res = await axios.get("/api/categories");
    const result = res.data.map((data) => ({
      value: data.id,
      title: data.name,
    }));
    categories.value = result;
  } catch (err) {
    return err.stack;
  }
}

const theme = useThemeStore();

const form = useForm({
  title: props.course?.title || "",
  description: props.course?.description || "",
  image: null,
  price: props.course?.price || null,
  duration: props.course?.duration || null,
  category_id: props.course?.category_id || "",
  objective: props.course?.objective || [],
  requirement: props.course?.requirement || [],
});

const previewUrl = ref(props.course?.image || "");
const objective = ref("");
const requirement = ref("");

function previewImage() {
  if (form.image !== null) {
    const reader = new FileReader();
    reader.onload = (event) => {
      previewUrl.value = event.target.result;
    };

    reader.readAsDataURL(form.image);
  }
}

function submit() {
  if (props.course) {
    form.submit("post", route("userCourse.edit", { course: props.course.id }));
    return;
  }
  form.submit("post", route("userCourse.store"));
}
</script>

<style scoped>
</style>