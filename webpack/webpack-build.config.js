var path = require('path');
var webpack = require('webpack');
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var config = require('./webpack-base.config')('dist')//引用finance.js

config.devtool = '#source-map'
config.module.loaders = config.module.loaders.concat(
    { test: /\.css$/, loader: ExtractTextPlugin.extract('style', 'css') },
    { test: /\.scss$/, loader: ExtractTextPlugin.extract('style', 'css!sass') }
)

config.vue.loaders = {
    js: 'babel',
    css: ExtractTextPlugin.extract("css"),
    sass: ExtractTextPlugin.extract("css!sass"),
}
//这里生成css文件
config.plugins = config.plugins.concat(
    new webpack.DefinePlugin({
        'process.env' : {
            NODE_ENV: '"production"'
        }
    }),
    new ExtractTextPlugin("dist/css/style.css"),
    new ExtractTextPlugin('dist/css/[name].css', {allTrunks: true}),
    new webpack.optimize.DedupePlugin(),
    new webpack.optimize.UglifyJsPlugin({
        compress: { warnings: false }
    })
)

module.exports = config;
