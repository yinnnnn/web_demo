var webpack = require('webpack')
var path = require('path')

var config = function(env) {
  return {
    entry: {
      'login': ['./src/js/entry/login.js'],
      'finance': ['./src/js/entry/finance.js'],
    },
    output: {
      publicPath: '/',
      path: path.join(__dirname, './'),
      filename: env + '/js/[name].js',
      chunkFilename: env + '/js/chunks/[name].js',
    },
    module: {
      loaders: [
        {
          test: /\.js$/,
          exclude: /node_modules|vue\/src|vue-router\/|vue-loader\/|vue-hot-reload-api\//,
          loader: 'babel'
        },
        { test: /\.vue$/, loader: 'vue' },
        {
          test: /\.(png|jpg|gif)$/,
          loader: 'file?name=dist/img/[name].[ext]',
          include: path.join(__dirname, 'src')
        }
      ]
    },
    vue: {},
    babel: {
      'presets': ['es2015', 'stage-0'],
      'plugins': ['transform-runtime']
    },
    resolve : {
      extensions: ['', '.js', '.vue', '.scss'],
      alias: {
        'jquery$': path.join(__dirname, 'dist/js/vendor/jquery.min'),
      },
    },
    externals: {
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
    },
    plugins: [
      new webpack.ProvidePlugin({
        'Promise': 'es6-promise',
        'fetch': 'imports?this=>global!exports?global.fetch!whatwg-fetch'
      }),
      new webpack.NoErrorsPlugin(),
      new webpack.optimize.CommonsChunkPlugin({
        name: 'common',
        minChunks: 2,
      })
    ]
  }
}

module.exports = config;
