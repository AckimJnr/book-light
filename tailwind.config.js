/** @type {import('tailwindcss').Config} */
// export default {
//   content: [],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'primary': {
          '500': '#00FF00',
        },
        'secondary': {
          '100': '#E2E2D5',
          '200': '#888883',
        }
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

