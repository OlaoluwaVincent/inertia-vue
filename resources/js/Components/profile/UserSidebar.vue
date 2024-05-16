<template>
  <!-- <v-btn color="success" @click="isOpen = !isOpen">Menu</v-btn> -->

  <!-- <v-navigation-drawer
    :location="$vuetify.display.mobile ? 'right' : 'left'"
    v-model="isOpen"
    class="!tw-max-h-fit"
  >
</v-navigation-drawer> -->
  <v-card
    width="350"
    class="profile__card !tw-bg-gray-200 tw-h-max"
    :class="theme.isDark && '!tw-bg-gray-900'"
  >
    <v-sheet class="upper" color="transparent">
      <v-img
        rounded="shaped"
        :src="user.profile_picture"
        :width="smAndDown ? 150 : 200"
        :height="smAndDown ? 150 : 200"
        cover
        position="top"
        class="!tw-object-bottom"
      />
      <h4>{{ user.fullname }}</h4>
      <v-btn
        flat
        append-icon="mdi-share-variant"
        :class="theme.isDark ? 'tw-text-white' : 'tw-text-gray-900'"
        variant="text"
        @click="handleShare"
      >
        Share Profile
      </v-btn>
    </v-sheet>

    <v-sheet class="lower" color="transparent">
      <v-list bg-color="transparent" class="!tw-flex tw-flex-col tw-gap-3">
        <Link
          v-for="item in items"
          :key="item.title"
          :href="item.value"
          class="link"
          :class="page.url.startsWith(item.value) && 'active'"
        >
          {{ item.title }}
        </Link>
      </v-list>
    </v-sheet>
  </v-card>
</template>

<script setup>
import { useDisplay } from "vuetify";
import { Link, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import { useThemeStore } from "@/store/theme";
const page = usePage();
const isOpen = ref(true);

const user = computed(() => page.props.auth.user);
const theme = useThemeStore();

const { smAndDown } = useDisplay();

const items = [
  { title: "Dashboard", value: "/dashboard" },
  {
    title: "Profile",
    value: "/profile",
  },
  instructorDetailsLink(),
  { title: "My Courses", value: "/my-courses" },
  { title: "Message", value: "/message" },
  { title: "Reviews", value: "/reviews" },
];

function instructorDetailsLink() {
  if (user.value.role === "INSTRUCTOR") {
    return {
      title: "My Details",
      value: "/my-details",
    };
  }
  return { title: "Colleagues", value: "/colleagues" };
}

function handleShare() {
  const url = window.location.href;

  navigator.clipboard
    .writeText(url)
    .then(() => {
      // Inform the user
      alert("Profile URL copied to clipboard!");
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Failed to copy profile URL to clipboard. Please try again.");
    });
}
</script>

<style scoped>
.profile__card {
  display: flex;
  flex-direction: column;
  padding: 10px;
  justify-content: center;
  gap: 20px;
  align-items: center;
  display: none;
}
@media (width >= 768px) {
  .profile__card {
    display: flex;
  }
}

.upper,
.lower {
  width: 100%;
  margin-inline: center;
  display: flex;
  align-items: center;
  flex-direction: column;
}

.upper {
  gap: 10px;
}

.lower {
  display: block;
}
.link {
  @apply tw-p-2 tw-rounded-md tw-transition-all hover:tw-bg-gray-800 hover:tw-ml-3 hover:tw-text-white;
}

.active {
  @apply tw-bg-gray-900 tw-text-white;
}

.link__dark {
  @apply tw-p-2 tw-rounded-md tw-transition-all hover:tw-bg-gray-100 hover:tw-text-gray-900;
}
.active__dark {
  @apply !tw-bg-gray-100 tw-text-gray-900;
}
</style>