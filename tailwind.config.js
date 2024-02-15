/** @type {import('tailwindcss').Config} */
module.exports = {
  daisyui: {
    themes: [
      {
        mytheme: {

          "primary": "#adce71",

          "secondary": "#f4971e",

          "accent": "#155b2a",

          "neutral": "#3d3c3b",

          "base-100": "#fffdf9",
        },
      },
    ],
  },

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.jsx",
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