/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/views/**/*.php","./app/views/**/*.html" ],
  theme: {
    extend: {},
    fontFamily: {
      sans: [
        '"Inter var", sans-serif',
        {
          fontFeatureSettings: '"cv11", "ss01"',
          fontVariationSettings: '"opsz" 32'
        },
      ],
      customFont: ['"Custom Font"', "sans-serif"],

    },
  },
  plugins: [
    function ({ addVariant }) {
      addVariant("child", "& > *");
    },
  ],
};