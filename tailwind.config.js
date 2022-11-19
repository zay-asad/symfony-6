/** @type {import('tailwindcss').Config} */
//compile everything in "assets" and "templates" folder
module.exports = {
  content: [
    "./assets/**/*.{vue,js,ts,jsx,tsx}",
    "./templates/**/*.{html,twig}"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
