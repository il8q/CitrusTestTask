// vue.config.js

/**
 * @type {import('@vue/cli-service').ProjectOptions}
 */
 

module.exports = {
  devServer: {
    proxy: {
      '/api': {
        target: 'http://localhost:8000',
        changeOrigin: true
      },
    }
  }
}
