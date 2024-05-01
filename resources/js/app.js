import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import GuestLayout from "./Layouts/GuestLayout.vue";
import vuetify from "./plugins/vuetify";
import pinia from "@/plugins/pinia";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => title || appName,
    resolve: async (name) => {
        const pageComponent = await resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );
        if (pageComponent && pageComponent.default) {
            pageComponent.default.layout =
                pageComponent.default.layout || GuestLayout;
            return pageComponent;
        } else {
            // if (pageComponent && pageComponent.default) {
            //     pageComponent.default.layout = GuestLayout;
            //     return pageComponent;
            // } else {
            console.error(
                `Page component not found or does not have a default export: ${name}`
            );
            // Return a default page component or handle the error as needed
            return {
                default: {
                    render: () => h("div", "Page not found"),
                    layout: GuestLayout,
                },
            };
        }
    },

    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue)
            .use(pinia)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
