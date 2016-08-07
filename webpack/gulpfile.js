/*
 * 路径：
 * gulpfile --> webpack-dev.config替换一下 --> webpack-base.config
 * 
 */

var gulp = require('gulp');
var uglify = require('gulp-uglify');///使用gulp-uglify压缩javascript文件，减小文件大小。
//webpack-build.config.js是build的时候用
//base相当于基类
var devConfig = require('./webpack-dev.config');
var webpack = require('webpack');
var webpackServe = require('webpack-dev-server');
var gutil = require('gulp-util');//打log抛异常
var fileinclude = require('gulp-file-include');//文件引用
var copy = require('gulp-contrib-copy');//copy css文件

gulp.task('minify', function () {
  gulp.src('js/app.js')
    .pipe(uglify())
    .pipe(gulp.dest('build'))
});

//执行任务顺序
gulp.task("list",['minify','sss'])

//依赖执行
gulp.task('css', ['greet'], function () {});
//默认
//gulp.task('default', function () {});
//gulp.task('default', ['styles', 'jshint', 'watch']);

var host =  'localhost';
var port = 80;

//启动服务
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
//  gulp.watch(['src/html/**/*.html'], ['htmlInclude']);//
//  gulp.watch(['src/img/**/*'], ['img']);
  gulp.watch(['src/**/*'], ['webpack:build']);//监听src的变化
});

gulp.task('webpack:build',function(cb){
    var buildConfig = require('./webpack-build.config');
    var config = Object.create(buildConfig);
    webpack(config,function (err,stats) {
        if (err) throw new gutil.PluginError('webpack:build',err);
//        gutil.log('[webpack:build]',stats.toString({ colors : true }));
        cb && cb();
    });
});

gulp.task('build',['webpack:build']);

//复制html gulp-file-include 替换 include语法？ !是什么意思？
gulp.task('htmlInclude', function() {
    //循环文件然后进行处理
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
//copy 框架文件
gulp.task('copyCss', function () {
  return gulp.src([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/bootstrap/dist/css/bootstrap-theme.min.css',
    'node_modules/bootstrap/dist/css/bootstrap-theme.min.css.map',
    'node_modules/bootstrap/dist/css/bootstrap.min.css.map',
  ])
  .pipe(copy({log: true}))
  .pipe(gulp.dest('./dist/css/vendor'));
})

gulp.task('copyJs', function() {
  return gulp.src([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js'
  ])
  .pipe(copy({ log: true }))
  .pipe(gulp.dest('./dist/js/vendor'))
})

gulp.task('default', ['server']);