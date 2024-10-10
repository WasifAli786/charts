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
            screens: {
                'xxxs': { 'min': '280px' },
                'xxs': { 'min': '392px' },
                'xs': { 'min': '528px' },
                'x': { 'min': '580px' },
                'sm': { 'min': '640px' },
                'md': { 'min': '769px' },
                'lg': { 'min': '1024px' },
                'xl': { 'min': '1280px' },
                '2xl': { 'min': '1440px' },
            },
            colors:
            {
                'seasalt':
                {
                    DEFAULT: '#f8f9fa',
                    100: '#29323a',
                    200: '#536475',
                    300: '#8496a8',
                    400: '#bfc8d1',
                    500: '#f8f9fa',
                    600: '#fafbfc',
                    700: '#fbfcfc',
                    800: '#fdfdfd',
                    900: '#fefefe'
                },
                'outer_space':
                {
                    DEFAULT: '#495057',
                    100: '#0e1011',
                    200: '#1d2022',
                    300: '#2b2f34',
                    400: '#3a3f45',
                    500: '#495057',
                    600: '#68727d',
                    700: '#8c959f',
                    800: '#b2b9bf',
                    900: '#d9dcdf'
                },
                'onyx': {
                    DEFAULT:
                        '#343a40',
                    100: '#0b0c0d',
                    200: '#15171a',
                    300: '#202327',
                    400: '#2a2f34',
                    500: '#343a40',
                    600: '#58626c',
                    700: '#7d8995',
                    800: '#a9b0b8',
                    900: '#d4d8dc'
                },
                'eerie_black':
                {
                    DEFAULT: '#212529',
                    100: '#070808',
                    200: '#0e0f11',
                    300: '#141719',
                    400: '#1b1f22',
                    500: '#212529',
                    600: '#49525b',
                    700: '#6f7d8b',
                    800: '#9fa8b2',
                    900: '#cfd4d8'
                },
                "primarygreen":"#30DEAB",
                "secondarygreen":"#29bd91",
                "primaryred":"#ff5972",
                "secondaryred":"#e34f65",
            },
            fontSize: {
                'xxs': '0.625rem'
            }
        },
    },

    plugins: [forms],
    plugins: [require("@tailwindcss/line-clamp")],

};