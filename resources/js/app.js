import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

createInertiaApp({
    id: "app",
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const appProps = {
            render: () => h(App, props),
            mounted() {
                console.log("mounted");
            },
            // layout: layout ? layout : null,
        };
        createApp(appProps)
            .use(plugin)
            .mount(el);
    },
});
