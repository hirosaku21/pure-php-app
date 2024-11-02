import type { Config } from 'tailwindcss'

const config: Config = {
  content: [
    './src/components/*.{js,ts,jsx,tsx,mdx}',
    './src/pages/*.{js,ts,jsx,tsx,mdx}',
  ],
  theme: {
    extend: {
      fontFamily: {
        montserrat: ['Montserrat Variable', 'sans-serif'],
        zen: ['Zen Kaku Gothic New', 'sans-serif'],
      },
      colors: {
        black: '#252525',
        white: '#FFF',
        danger: 'red',
        gray: '#EEE',
        blue: 'blue',
      },
    },
  },
}

export default config
