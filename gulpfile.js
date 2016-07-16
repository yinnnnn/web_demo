var gulp = require('gulp');
var gutil = require('gulp-util');
var clean = require('gulp-clean');
var watch = require('gulp-watch');
var copy = require('gulp-contrib-copy')

var webpack = require('webpack');
var webpackServe = require('webpack-dev-server');
var fileinclude = require('gulp-file-include');
var devConfig = require('./webpack-dev.config');
// var livereload = require('gulp-livereload');
var devip = require("dev-ip");
var ip = devip();
var host = ip[0] || 'localhost';
var port = 80;

gulp.task('htmlInclude', function() {
  return gulp.src(['src/html/**/*.html', '!src/html/include/*.html']).pipe(fileinclude({
      prefix: '@@',
      basepath: './src/html/include',
      context: {
        nav: true
      }
    })).on('error', function (err) {
      console.log(err.plugin + ': ' + err.message);
    }).pipe(gulp.dest('dist/html'));
});

gulp.task('server', function() {
  var config = Object.create(devConfig);
  var compiler = webpack(config);
  new webpackServe(compiler, {
    publicPath: '/',
    stats: {colors: true},
    hot: true,
    progress: true,
  }).listen(port, host, function(err) {
    if (err) throw new gutil.PluginError('webpack-dev-server', err);
    gutil.log('[webpack-dev-server]', 'http://' + host + ':'+ port +'/webpack-dev-server/index.html');
    gutil.log('[webpack-dev-server]', 'src->dev,Success!');
  });
  gulp.watch(['src/html/**/*.html'], ['htmlInclude']);

  // livereload.listen();
  // gulp.watch('dist/html/**/*.html', function () {
  //   gulp.src('dist/html/**/*.html').pipe(livereload());
  // });

  gulp.watch(['src/img/**/*'], ['img']);
  gulp.watch(['src/**/*'], ['webpack:build-dev']);
});


gulp.task('webpack:build-dev', function(cb) {
    var config = Object.create(devConfig);
    gutil.log('[webpackConfig]',config.devtool);
    var devCompiler = webpack(config);
    devCompiler.run(function(err, stats) {
        if (err) throw new gutil.PluginError('webpack:build-dev', err);
        gutil.log('[webpack:build-dev]', stats.toString({ colors: true }));
        cb && cb();
    });
});

gulp.task('webpack:build',function(cb){
    var buildConfig = require('./webpack-build.config');
    var config = Object.create(buildConfig);
    webpack(config,function (err,stats) {
        if (err) throw new gutil.PluginError('webpack:build',err);
        gutil.log('[webpack:build]',stats.toString({ colors : true }));
        cb && cb();
    });
});


var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
gulp.task('imagemin', function (cb){
  return gulp.src('src/img/**/*')
    .pipe(imagemin({
      progressive: true,
      svgoPlugins: [{removeViewBox: false}],
      use: [pngquant()]
    }))
    .pipe(gulp.dest('dist/img/'))
});

gulp.task('img', function (cb){
  return gulp.src('src/img/**/*')
    .pipe(gulp.dest('dist/img'));
});

gulp.task('clean', function () {
  return gulp.src(['dist/'], {read: false})
    .pipe(clean());
});

gulp.task('cleanChunks', function () {
    return gulp.src(['dist/js/chunks/', 'dev/js/chunks/'], {read: false})
        .pipe(clean());
});

gulp.task('copyJs', function() {
  return gulp.src([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js'
  ])
  .pipe(copy({ log: true }))
  .pipe(gulp.dest('./dist/js/vendor'))
})

gulp.task('copyCss', function () {
  return gulp.src([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/bootstrap/dist/css/bootstrap-theme.min.css'
  ])
  .pipe(copy({log: true}))
  .pipe(gulp.dest('./dist/css/vendor'));
})

gulp.task('copy', ['copyJs', 'copyCss']);

gulp.task('init', ['copy', 'img', 'htmlInclude']);

gulp.task('default', ['server']);

gulp.task('build', ['cleanChunks', 'webpack:build']);

gulp.task('build-dev', ['webpack:build-dev']);

var gulpsync = require('gulp-sync')(gulp);
gulp.task('release', gulpsync.sync(['clean', 'copy', 'webpack:build', 'imagemin']))
