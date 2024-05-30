<template>
  <section
    id="banner"
    class="content__padding tw-flex tw-flex-col-reverse md:tw-flex-row tw-items-center tw-justify-between tw-gap-10"
  >
    <v-card class="" variant="flat" max-width="550" color="transparent">
      <template v-slot:title>
        <h1
          class="tw-text-[24px] lg:tw-text-[32px] xl:tw-text-[40px] tw-text-wrap"
        >
          Unlock Your Potential with School
        </h1>
      </template>

      <template v-slot:text>
        <p class="tw-w-full">
          Welcome to Byway, where learning knows no bounds. We believe that
          education is the key to personal and professional growth, and we're
          here to guide you on your journey to success.
        </p>
      </template>

      <template v-slot:actions>
        <v-btn
          color="blue-darken-2"
          text="Start your Journey"
          variant="elevated"
          class="px-5"
        ></v-btn>
      </template>
    </v-card>

    <div class="tw-flex">
      <v-img
        :width="$vuetify.display.smAndDown ? 300 : 450"
        aspect-ratio="16/9"
        cover
        src="../../../../assets/images/homepageImg.png"
      ></v-img>
    </div>
  </section>
</template>
