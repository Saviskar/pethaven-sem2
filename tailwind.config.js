import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'theme-light': '#FDFDFC',
                'theme-dark': '#0a0a0a',
                'card-light': '#ffffff',
                'card-dark': '#161615',
                'border-light': '#e3e3e0',
                'border-dark': '#3E3E3A',
                'text-light': '#1b1b18',
                'text-dark': '#EDEDEC',
                'text-muted-light': '#706f6c',
                'text-muted-dark': '#A1A09A',
            },
        },
    },

    plugins: [forms, typography],
};
