import {debounce} from "lodash";
import axios from "axios";
import {ref} from "vue";

const courses = ref(null)
const searchQuery = ref('')

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
        courses.value = null;
    }
}, 300);

// Main search function that calls the debounced version
const search = (searchText) => {
    searchQuery.value = searchText;
    debouncedSearch();
};

export {courses, search}
