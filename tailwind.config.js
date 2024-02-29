/** @type {import('tailwindcss').Config} */
module.exports = {
  daisyui: {
    themes: [
      {
        mytheme: {

          "primary": "#adce71",

          "secondary": "#f4971e",

          "accent": "#e08c1a",

          "neutral": "#155b2a",

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
      screens: {
        'tallscreen': { 'raw': '(min-aspect-ratio: 13/20)' },
      },
      keyframes: {
        'open-menu': {
          '0%': { transform: 'scaleY(0)' },
          '80%': { transform: 'scaleY(1,2)' },
          '100%': { transform: 'scaleY(1)' },
        }
      },
      animation: {
        'open-menu': 'open-menu 0.5s ease-in-out forwards',
      }
    },
  },





  plugins: [require("daisyui")],
}