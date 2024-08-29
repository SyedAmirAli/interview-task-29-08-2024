import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.{vue,js,css,html,ts}",
    ],

    theme: {
        container: {
            center: true,
            padding: "1rem", // Customize padding as needed
            screens: {
                xs: "320px",
                sm: "540px",
                md: "720px",
                lg: "960px",
                xl: "1140px",
                "2xl": "1320px",
            },
        },

        extend: {
            colors: {
                primary: {
                    main: "#5236FF",
                    dark: "#242331",
                },
                secondary: {
                    light: "#F9F9F9",
                    main: "#EFECFF",
                    dark: "#242331",
                    gray: "#797979",
                },
            },
        },
    },

    plugins: [forms],
};
