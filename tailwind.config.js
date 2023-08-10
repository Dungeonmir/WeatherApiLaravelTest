/** @type {import('tailwindcss').Config} */
export default {
  content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  theme: {
    extend: {
        colors: {
            'blue': '#1da1f2',
        }
    },
  },
    plugins: [
        require('tailwindcss'),
        require('autoprefixer'),
    ]
}

