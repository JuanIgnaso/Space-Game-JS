/** @type {import('tailwindcss').Config} */

const plugin = require('tailwindcss/plugin');
module.exports = {
  content: ["./views/**/*.{html,js,css,php}"],
  theme: {
    extend: {},
  },
  plugins: [
    plugin(function({ addUtilities, addComponents, e, config }) {
      // Add your custom styles here
    }),
    require('@tailwindcss/forms'),
  ],
}


