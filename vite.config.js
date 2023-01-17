import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/search.js",
                "resources/js/section_actions.js",
                "resources/js/text_customize.js",
            ],
            refresh: true,
        }),
    ],
});
