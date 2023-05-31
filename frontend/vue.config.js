module.exports = {
  transpileDependencies: ['vuetify'],

  devServer: {
    proxy: 'http://nginx/'
  }
}
