/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      backgroundImage: {
        'hero-bg':"url('/public/pexels-fauxels-3184418.jpg')"
      },
      boxShadow: {
        'navShadow':'0px 10px 13px -10px rgba(0,0,0,0.59)'
      }
    },
    container:{
      center: true,
    },
  },
  plugins: [
    require('flowbite/plugin'),
  ],
}

