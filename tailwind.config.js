/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: ["./*.php"],
  theme: {
    fontFamily: {
      'title': ['p22-mackinac-pro',...defaultTheme.fontFamily.sans],
      'content': ['rival-sans',...defaultTheme.fontFamily.serif],
    },
    extend: {
      colors: {
        'nav-bg': '#FDFEFD',
        'light-green': '#499B5B',
        'dark-green' : '#2E6347',
        'g-light-green' : '#4C9669',
        'g-dark-green' : '#2E6347',
        'g-light-white' : '#F9FCFA',
        'g-gray' : '#EAEBEC',
        'dark-yellow' : '#625D53',
        'light-yellow' : '#C5CD9E',
        'gc-light-green' : '#5A8462',
        'gc-dark-green' : '#244831',
        'gray' : '#EAEBEC',
        'pastel' : '#F5F0E6',
      },
      container: {
        padding: '4.688rem'
      },
      gap: {
        'nav' : '4.063rem',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/line-clamp'),
  ],
}
