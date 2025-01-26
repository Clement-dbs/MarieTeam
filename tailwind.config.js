/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./MVC/**/*.{php,js}", 
    "./CSS/**/*.css"
  ],

  theme: {
    extend: {
      fontFamily:{
        NeueMontrealRegular:['NeueMontrealRegular'],
        NeueMontrealBold:['NeueMontrealBold']
      },
      colors:{
        header: '#111111',
        "primary-color": "var(--primary-color)",
        "secondary-color": "var(--secondary-color)",
      }
    },
  },
  plugins: [],
}

