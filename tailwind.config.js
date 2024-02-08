/** @type {import('tailwindcss').Config} */
module.exports = {
  daisyui: {
    themes: ["light", "cupcake"],
  },

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.jsx",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      },
    },
  },
  plugins: [require("daisyui")],
}