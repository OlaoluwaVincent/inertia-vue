<template>
  <template v-if="$vuetify.display.mdAndUp">
    <div
      class="tw-flex tw-items-center tw-w-[300px] xl:tw-w-[500px] tw-relative"
    >
      <div
        class="tw-border tw-relative tw-rounded-xl tw-border-primary-100 tw-overflow-x-hidden flex-row-center relative tw-ms-[50px] tw-flex-1 tw-mx-auto"
      >
        <label
          for="search"
          class="tw-absolute tw-top-1/2 tw-left-2 -tw-translate-y-1/2 tw-cursor-pointer"
        >
          <v-icon class="tw-text-gray-950">mdi-magnify</v-icon>
        </label>
          <input
              type="text"
              id="search"
              autocomplete="search"
              class="tw-bg-gray-100 tw-w-full tw-ring-0 tw-outline-none tw-block tw-pl-10 tw-text-gray-950"
              placeholder="Search Courses"
              v-model="searchQuery"
              @input="search"
          />
      </div>
        <SearchResult :courses="courses" />
    </div>
  </template>
</template>

<script setup>
import {ref} from "vue";
import axios from "axios";
import {debounce} from "lodash";
import SearchResult from "@/Components/SearchResult.vue";

const searchQuery = ref('');
const courses = ref([]);

const debouncedSearch = debounce(() => {
    if (searchQuery.value.length > 2) {
        axios.get(route('courses.search'), { params: { query: searchQuery.value } })
            .then(response => {
                courses.value = response.data;
            })
            .catch(error => {
                console.error('Error fetching courses:', error);
            });
    } else {
        courses.value = [];
    }
}, 300);

// Main search function that calls the debounced version
const search = () => {
    debouncedSearch();
};
</script>
