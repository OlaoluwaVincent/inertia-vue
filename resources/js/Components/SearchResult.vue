<script setup>
import {useThemeStore} from "@/store/theme.js";

const props = defineProps({
    courses: Array,
})
const theme = useThemeStore();
</script>

<template>
    <div class="results tw-bg-slate-400" v-if="courses.length">
        <v-virtual-scroll
            :items="courses"
            height="320"
            item-height="48"
        >
            <template v-slot:default="{ item }">
                <v-list-item
                    :title="item.title"
                >
                    <template v-slot:prepend>
                        <v-avatar :image="item.image" size="50"></v-avatar>
                    </template>

                    <template v-slot:append>
                        <p>{{item.price}}</p>
                    </template>
                </v-list-item>
            </template>
        </v-virtual-scroll>
    </div>
</template>

<style scoped>
.results{
    position:absolute;
    top: 50px;
    left: 0;
    width: 100%;
    min-height:100%;
    height:auto;
    max-height: 400px;
    z-index: 900;
}
</style>
