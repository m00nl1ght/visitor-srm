import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],

  server: {
    proxy: {
      // Using the proxy instance
      '/api': {
        target: 'http://localhost:80/',
        // secure: false,
        // rewrite: (path) => path.replace(/^\/api/, ""),
        // changeOrigin: true,
        // configure: (proxy, options) => {
        //   // proxy will be an instance of 'http-proxy'
        // }
      },
    }
  },

  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
    },
  }
})

// export default defineConfig({
//   server: {
//     proxy: {
//       // string shorthand
//       '/foo': 'http://localhost:4567',
//       // with options
//       '/api': {
//         target: 'http://jsonplaceholder.typicode.com',
//         changeOrigin: true,
//         rewrite: (path) => path.replace(/^\/api/, '')
//       },
//       // with RegEx
//       '^/fallback/.*': {
//         target: 'http://jsonplaceholder.typicode.com',
//         changeOrigin: true,
//         rewrite: (path) => path.replace(/^\/fallback/, '')
//       },
//       // Using the proxy instance
//       '/api': {
//         target: 'http://jsonplaceholder.typicode.com',
//         changeOrigin: true,
//         configure: (proxy, options) => {
//           // proxy will be an instance of 'http-proxy'
//         }
//       },
//       // Proxying websockets or socket.io
//       '/socket.io': {
//         target: 'ws://localhost:5173',
//         ws: true
//       }
//     }
//   }
// })