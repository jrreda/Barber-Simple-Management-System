import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],

    safelist: [
        'bg-green-100',
        'border-green-500',
        'text-green-700',
        'bg-red-100',
        'border-red-500',
        'text-red-700',
        'bg-yellow-100',
        'border-yellow-500',
        'text-yellow-700',
        'bg-blue-100',
        'border-blue-500',
        'text-blue-700'
    ]
};
