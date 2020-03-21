const {defaultTheme} = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        extend: {
            inset: {
                '-1': '-0.25rem',
                '-2': '-0.5rem',
                '-3': '-0.75rem',
                '-4': '-1rem',
                '-5': '-1.25rem',
                '-6': '-1.5rem',
                '-7': '-1.75rem',
                '-8': '-2rem',
                '-16': '-4rem',
                '0': '0',
                '1': '0.25rem',
                '2': '0.5rem',
                '3': '0.75rem',
                '4': '1rem',
                '5': '1.25rem',
                '6': '1.5rem',
                '7': '1.75rem',
                '8': '2rem',
                '16': '4rem',
            },
            spacing: {
                '17': '4.25rem',
                '18': '4.5rem',
                '19': '4.75rem',
            },
            colors: {
                dark: '#222222',
                main: {
                    '100': '#F9B91F',
                    '200': '#F8B000',
                }
            },
        },
    },
    variants: {},
    plugins: [],
}
