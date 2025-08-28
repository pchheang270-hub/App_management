/** @type {import('tailwindcss').Config} */
// tailwind.config.js
module.exports = {
  content: [
  './resources/**/*.blade.php',
  './resources/**/*.js',
  './resources/**/*.vue',
  './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
],

  theme: {
    extend: {},
  },
  plugins: [],
}