<template>
    <section class="tw-mb-10 tw-relative content__padding tw-min-h-[90svh]"
        :class="theme.isDark ? 'tw-bg-gray-800' : 'tw-bg-gray-50'">
        <div class="tw-relative">

            <CourseBanner :course="props.course" />
            <CourseBannerCard :isExistInCart="isExistInCart" :course="course" />

        </div>
        <div class="tw-flex md:tw-hidden tw-flex-col tw-gap-5 tw-mt-5 tw-mx-auto tw-w-[80%] ">
            <v-btn v-if="isExistInCart" block density='default' @click="removeFromCart"
                :class="theme.isDark ? 'light' : 'dark'">Remove From
                Cart</v-btn>

            <v-btn v-else block density='default' @click="addToCart" :class="theme.isDark ? 'light' : 'dark'">Add To
                Cart</v-btn>

            <v-btn block density='default' :class="theme.isDark ? 'dark' : 'light'">Buy Now</v-btn>
        </div>

        <v-snackbar v-model="snackbar" :timeout="timeout" color="primary">
            Added to Cart

            <template v-slot:actions>
                <v-btn color="warning" variant="text" @click="snackbar = false">
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </section>

</template>

<script setup>
import CourseBanner from '@/Components/course/CourseBanner.vue';
import CourseBannerCard from '@/Components/course/CourseBannerCard.vue';
import { useThemeStore } from '@/store/theme';
import { useCartStore } from '@/store/cart'
import { computed, ref } from 'vue';

const timeout = ref(2000)
const snackbar = ref(false)

const cartStore = useCartStore()
const theme = useThemeStore()
const props = defineProps({
    course: Object
})

const isExistInCart = computed(() => cartStore.checkExisting(props.course.id))

function addToCart() {
    cartStore.addToCart(props.course)
    snackbar.value = true
}

function removeFromCart() {
    cartStore.removeFromCart(props.course.id)
}
</script>


<style scoped>
.dark {
    background: #222;
    color: white;
}

.light {
    background: white;
    color: #222;
    border: 1px solid #222;
}
</style>