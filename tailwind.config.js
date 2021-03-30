const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/components/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                serif: ['Lobster', ...defaultTheme.fontFamily.serif],
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            animation: ['responsive', 'motion-safe', 'motion-reduce']
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
