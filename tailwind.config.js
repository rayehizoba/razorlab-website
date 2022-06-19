const colors = require('tailwindcss/colors')

module.exports = {
    mode: "jit",
    content: [
        "./vendor/filament/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    purge: {
        content: [
            "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
            "./vendor/laravel/jetstream/**/*.blade.php",
            "./storage/framework/views/*.php",
            "./resources/views/**/*.blade.php",
            './vendor/filament/**/*.blade.php',
            './vendor/wire-elements/modal/resources/views/*.blade.php',
        ],
        safelist: [
            {
                pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
                variants: ['sm', 'md', 'lg', 'xl', '2xl'],
            },
        ],
    },
    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                secondary: '#0f0f0f',
                'secondary-alt': '#383838',
                light: '#f8f6f5',
                'light-alt': '#e1e0df',
            },
        },
        fontFamily: {
            'sans': ['Poppins', 'Helvetica, Arial, sans-serif']
        },
        container: {
            padding: '1.25rem',
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
