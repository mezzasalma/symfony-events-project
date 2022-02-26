const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
  //content: [
  //  "./src/**/*.php",
  //  "./templates/**/*.twig",
  //  "./styles/**/*.css"
  //],
  content: [
    "./assets/**/*.{vue,js,ts,jsx,tsx}",
    "./templates/**/*.{html,twig}",
    // "./src/**/*.{php}",
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  important: true,
  plugins: [],
}
