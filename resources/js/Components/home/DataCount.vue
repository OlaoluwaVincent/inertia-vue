<template>
    <v-sheet id="count" color="grey-lighten-3"
        class="!tw-flex !tw-flex-col md:!tw-flex-row !tw-gap-10 !tw-items-center !tw-justify-between content__padding !tw-py-10">
        <v-sheet v-for="(item, key) in items" :key="key" class="tw-flex tw-items-center" color="transparent">
            <h4 class="tw-text-center tw-text-3xl tw-font-bold">{{ item.title }}+</h4>
            <p class="tw-text-center">{{ item.desc }}</p>
        </v-sheet>
    </v-sheet>
</template>


<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({ data: Object });
const coursesCount = ref(null)
const lessonHrs = ref(null)
const instructorsCount = ref(null)

const items = [
    { title: ref(null), desc: "Courses by our Mentors" },
    { title: ref(null), desc: "Hours of Lessons" },
    { title: ref(null), desc: "Worthy Instructors" }
];


function getCounts() {
    axios.get('/api/coursescount').then(response => {
        const data = response.data
        coursesCount.value = data.coursesNum;
        lessonHrs.value = data.lessonHrs;
        updateItems();
    }).catch(error => {
        console.error('Error fetching items:', error)
    })
}
function getInstructorsCount() {
    axios.get('/api/instructorsCount').then(response => {
        instructorsCount.value = response.data;
        updateItems();
    }).catch(error => {
        console.error('Error fetching items:', error)
    })
}

function updateItems() {
    items[0].title.value = coursesCount.value;
    items[1].title.value = lessonHrs.value;
    items[2].title.value = instructorsCount.value;
}

onMounted(() => {
    getCounts();
    getInstructorsCount();
})
</script>



<style></style>
