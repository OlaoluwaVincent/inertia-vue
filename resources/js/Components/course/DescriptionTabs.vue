<template>
    <section>
        <v-card>
            <v-tabs v-model="tab" bg-color="teal-darken-4">
                <v-tab v-for="tab in tabs" :value="tab">{{ tab }}</v-tab>
            </v-tabs>


            <v-card-text>
                <div v-for="key in tabs" :key="key" v-show="key === tab">
                    <slot :name="key" />
                </div>
            </v-card-text>
        </v-card>
    </section>
</template>

<script setup>
import { ref, watch } from 'vue';

const emit = defineEmits(['tabTitle'])
const props = defineProps({
    tabs: Array
})

const tab = ref(props.tabs[0]);

watch(tab, (newValue, oldValue) => {
    emit('tabTitle', newValue)
});
</script>
