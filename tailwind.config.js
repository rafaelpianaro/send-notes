import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		 './storage/framework/views/*.php',
		 './resources/views/**/*.blade.php',
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
		forms,
		require("daisyui")
	],

    // daisyui: {
    //     themes: [
    //         {
    //             mary: {
    //                 primary: colors.rose[500],
    //                 secondary: colors.indigo[700],
    //                 // secondary: colors.purple[500],
    //                 accent: colors.cyan[400],
    //                 neutral: colors.gray[500],
    //                 "base-100": colors.gray[100],
    //                 success: colors.green[600],
    //                 error: colors.red[600],
    //             },
    //         },
    //         "light",
    //         "dark",
    //     ],
    // },
};