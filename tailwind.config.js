import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                header: ["Inknut Antiqua", ...defaultTheme.fontFamily.serif],
            },
            backgroundImage: {
                "hero-background":
                    "url('/public/images/tiago-aleixo-ToUPFfxkmw8-unsplash.jpg')",
            },
        },
    },

    plugins: [forms],
};
