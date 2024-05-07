<template>
    <section class="courseBannerCard">

        <v-card class="mx-auto !tw-p-5 !tw-rounded-2xl" max-width="374">
            <v-img height="250" class="!tw-rounded-2xl" src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
                cover></v-img>

            <v-card-item>
                <v-card-title>Cafe Badilico</v-card-title>

                <v-card-subtitle>
                    <span class="me-1">Local Favorite</span>

                    <v-icon color="error" icon="mdi-fire-circle" size="small"></v-icon>
                </v-card-subtitle>
            </v-card-item>

            <div class="tw-flex tw-flex-col tw-gap-5">
                <v-btn block density='default' :class="theme.isDark ? 'light' : 'dark'">Add To Cart</v-btn>

                <v-btn block density='default' :class="theme.isDark ? 'dark' : 'light'">Buy Now</v-btn>
            </div>
            <v-divider class="mx-4 my-1"></v-divider>
            <div class="tw-py-5">
                <h5>Share</h5>
                <div>
                    <v-icon name="ri-refresh-line" animation="spin" hover />
                    <v-icon name="ri-refresh-line" animation="spin" hover />
                    <v-icon name="ri-refresh-line" animation="spin" hover />
                    <v-icon name="ri-refresh-line" animation="spin" hover />
                </div>
            </div>
        </v-card>
    </section>
</template>

<script setup>
import { useThemeStore } from '@/store/theme';

const theme = useThemeStore()
const props = defineProps({
    image: String,
    id: Number,
    price: String
})
</script>

<style scoped>
.courseBannerCard {
    position: absolute;
    top: 30px;
    right: 5%;
}

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