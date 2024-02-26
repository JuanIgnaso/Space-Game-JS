/** @type {import('tailwindcss').Config} */

const plugin = require('tailwindcss/plugin');
module.exports = {
  content: ["./views/**/*.{html,js,css,php}"],
  theme: {
    /*Customizar media breakpoints*/
    // screens:{
    //   'movil':'500px',
    //   'tablet':'900px',
    //   'desktop':'1300px',
    //   //movil:text-xl
    // },
    /*Customizar colores*/
    // colors:{
    //   'micolor':'#codigo',
    //   'tonoAzulClaro':'#codigo'
    //  text-tonoAzulClaro
    // },
    extend: {
      rotate:{
        '20':'20deg',
        '340':'340deg',
      }
    },
  },
  plugins: [
    plugin(function({ addUtilities, addComponents, e, config }) {
      // Add your custom styles here
    }),
    require('@tailwindcss/forms'),
    
    require("tailwind-heropatterns")({
      // the list of patterns you want to generate a class for
      // the names must be in kebab-case
      // an empty array will generate all 87 patterns
      patterns: ['bubbles'],
    
      // The foreground colors of the pattern
      // if you don't specify a color, the default will be used
      colors: {
        default: "#e5e5e5",
        "black": "#00000" //also works with rgb(0,0,205)
      },
    
      // The foreground opacity
      opacity: {
        default: "0.2",
        "100": "1.0"
      }
    })
  ],
}


