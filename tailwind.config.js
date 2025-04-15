import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: null,
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist:[
        'bg-white',
        'bg-blue-200',
        'bg-red-200',
        'bg-green-200',
        'text-blue-900',
        'text-red-900',
        'text-green-900',
        'bg-green-90',
        'bg-red-900',
    ],
    theme: {
        // colors:{
        //     'menta': '#ACDCC2',
        //     'zafiro': '#D6DBFF',
        //     'blanco-nieve': '#ECF5F1 ',
        //     'azul-glasswing': '#0092A0',
        // },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'menta': '#ACDCC2',
                'zafiro': '#D6DBFF',
                'blanco-nieve': '#ECF5F1 ',
                'azul-glasswing': '#0092A0',
                'dark-gray': '#111613',
                'dark-green': '#566E61',
                'club-nna-bg': '#b193c4',
                'club-nna': '#231D27',
                'club-nna-bg-2': '#6A5876',
                // Re-assign Flux's base color (zinc) to a different shade of gray...
                accent: {
                    DEFAULT: 'var(--color-accent)',
                    content: 'var(--color-accent-content)',
                    foreground: 'var(--color-accent-foreground)',
                },
            }
        },
    },

    plugins: [forms],
};
