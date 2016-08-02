var path = require('path');
var hot = 'webpack/hot/dev-server';
var webpack = require('webpack');
var config = require('./webpack-base.config')('dev')//指定输出目录

var devip = require('dev-ip');
var ip = devip();
var host = ip[0] || 'localhost';
var port = 80;

for (var i = 0; i < config.entry.length; i++) {
    config.entry[i].push(hot);
}

config.output.publicPath = 'http://' + host + ':'+ port +'/'
config.debug = true;
config.devtool = 'eval'

var hot = 'webpack/hot/only-dev-server'
config.entry['dev-server'] = ['webpack-dev-server/client?' + host + ':' + port]
/*固定规则*/
config.module.loaders = config.module.loaders.concat(
    { test: /\.css$/, loader: 'style!css' },
    { test: /\.scss$/, loader: 'style!css?sourceMap!sass' }
)

config.vue.loaders = {
    loaders: {
        js: 'babel',
    }
}

config.plugins = config.plugins.concat(
    new webpack.HotModuleReplacementPlugin()
)

module.exports = config;
