const defaultTheme = require('tailwindcss/defaultTheme');


/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary:  "#1b4e68",
        secondary:"#d5c3a3",
        accent1:  "#7ab6c4",
        accent2:  "#498cdd",
      },
    },
  },
  plugins: [],
}
