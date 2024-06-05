<template>
    <section class="courseBannerCard tw-relative">
        <p class="tw-absolute tw-top-10 tw-left-10 bg-teal-darken-3 tw-rounded-2xl pa-4 tw-z-10 tw-text-lg">
            ${{ course.price }}</p>
        <v-card class="mx-auto !tw-p-5 !tw-rounded-2xl card__wrapper">
            <v-img
                height="180"
                class="!tw-rounded-2xl"
                :src="course.image"
                cover
            ></v-img>

            <v-card-item>
                <v-card-title>{{ course.title }}</v-card-title>

                <v-card-subtitle>
          <span class="me-1"
          >Created by {{ course.instructor.user.fullname }}</span
          >

                    <v-icon color="error" icon="mdi-fire-circle" size="small"></v-icon>
                </v-card-subtitle>
            </v-card-item>

            <div class="tw-flex tw-flex-col tw-gap-5">
                <v-btn
                    v-if="isExistInCart"
                    @click="removeFromCart"
                    block
                    density="default"
                    :class="theme.isDark ? 'light' : 'dark'"
                >Remove From Cart
                </v-btn
                >
                <v-btn
                    v-else
                    @click="addToCart"
                    block
                    density="default"
                    :class="theme.isDark ? 'light' : 'dark'"
                >Add To Cart
                </v-btn
                >

                <v-btn block density="default" @click="proceedToCheckout" :class="theme.isDark ? 'dark' : 'light'"
                >Buy Now
                </v-btn
                >
            </div>
            <v-divider class="mx-4 my-1"></v-divider>
            <div class="tw-py-5">
                <h5>Follow</h5>
                <div class="text-center">
                    <v-icon
                        icon="mdi-facebook"
                        @click="socialMediaShare.shareOnFacebook()"
                        class="!tw-text-4xl !tw-shadow-2xl tw-rounded-full !tw-bg-gray-200 !tw-text-blue-700"
                    ></v-icon>
                </div>
            </div>
        </v-card>
    </section>
    <CartSnackBar v-model="snackbar"/>
</template>

<script setup>
import {useThemeStore} from "@/store/theme";
import SocialMediaShare from "@/utils/shareCourse";
import {useCartStore} from "@/store/cart";
import CartSnackBar from "@/Components/SnackBar.vue";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const socialMediaShare = new SocialMediaShare(window.location.pathname);
const cartStore = useCartStore();
const snackbar = ref(false);

const theme = useThemeStore();

const props = defineProps({
    course: Object,
    isExistInCart: Boolean,
});


function addToCart() {
    cartStore.addToCart(props.course);
    snackbar.value = true;
}

function removeFromCart() {
    cartStore.removeFromCart(props.course.id);
}

const form = useForm({
    amount: parseFloat(props.course.price),
    metadata:[{
        id: props.course.id,
        title: props.course.title,
    }],
});

function proceedToCheckout() {
    form.post('/pay');
}
</script>

<style scoped>
.courseBannerCard {
    position: absolute;
    top: 30px;
    right: 4%;
    display: none;
}

.card__wrapper {
    width: 280px;
}

.dark {
    background: #222;
    color: white;
    border: 1px solid #fff;
}

.light {
    background: white;
    color: #222;
    border: 1px solid #222;
}

@media (width >= 768px) {
    .courseBannerCard {
        right: 2%;
        display: block;
    }
}

@media (width > 1024px) {
    .courseBannerCard {
        right: 20px;
    }

    .card__wrapper {
        width: 385px;
    }
}
</style>
