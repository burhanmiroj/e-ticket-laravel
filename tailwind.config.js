const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                'custom' : '1180px'
            },
            colors: ({ colors }) => ({
              green: {...colors.green, 1000: '#008641', 1100: '#50B749'},
            }),
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
