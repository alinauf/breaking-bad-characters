const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

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

                '2xl': '1536px',
                // => @media (min-width: 1536px) { ... }
            },
            colors: {
                'primary': {
                    DEFAULT: '#049F77',
                    '50': '#B4FDEA',
                    '100': '#97FCE2',
                    '200': '#5BFBD2',
                    '300': '#1FF9C1',
                    '400': '#05D6A0',
                    '500': '#049A73',
                    '600': '#038665',
                    '700': '#037256',
                    '800': '#025F47',
                    '900': '#024B38'
                }
            },

        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/aspect-ratio'),
    ],
};
