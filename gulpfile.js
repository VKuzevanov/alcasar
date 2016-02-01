var gulp = require('gulp'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	jshint = require('gulp-jshint'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	plumber = require('gulp-plumber'),
	notify = require('gulp-notify'),
    prefix = require('gulp-autoprefixer'),
    minifyCss = require('gulp-minify-css');

var err = { errorHandler: notify.onError({
 
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
 
  })
};

var	browserSync = require('browser-sync'),
	reload = browserSync.reload;

var fs = require('node-fs'),
	fse = require('fs-extra'),
	json = require('json-file'),
	//ayoRefry = require('ayo-refry'),
 	themeName = json.read('./package.json').get('themeName'),
 	themeDir = '../' + themeName;

//build folder
gulp.task('nf', function() {
 	
 	fs.mkdirSync(themeDir, 765, true);
	fse.copySync('app', themeDir + '/');
 
});
//browser-sync
gulp.task('browser-sync', function() {
    //watch files
    var files = [
    './app/scss/*.scss',
    './app/css/*.css',
    './app/style.css',
    './app/js/*.js',
    './app/*.php',
    './app/*.html'
    ];
 
    //initialize browsersync
    browserSync.init(files, {
    //browsersync with a php server
    proxy: "http://alcasar-sk.ru:8080",
    notify: false
    });
});
//scss to css
gulp.task('sass', function () {
    
    return gulp.src('./app/scss/**/*.scss')
    .pipe(plumber(err))
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(prefix('last 1 version', '> 1%', 'ie 8'))
    .pipe(minifyCss())
    .pipe(gulp.dest('./app/scss/')) 
    .pipe(sourcemaps.write('./app/css'))
    .pipe(reload({stream:true}));
});
gulp.task('css', function(){
	return gulp.src('./app/scss/*.css')
	.pipe(plumber(err))
    .pipe(concat('style.css'))
    .pipe(gulp.dest('./app/'))
})
////js
//gulp.task('js', function () {
// 
// 	return gulp.src('./app/js/vendor/*.js')
//	.pipe(plumber(err))
//	.pipe(sourcemaps.init())
//	.pipe(jshint())
//	.pipe(jshint.reporter('fail'))
//	.pipe(uglify())
//	.pipe(concat('theme.js',{newLine: ';'}))
//	.pipe(sourcemaps.write('../js')) 
//	.pipe(gulp.dest('app/js'))
//	.pipe(reload({stream:true}))
//});
//watch
gulp.task('default', ['sass','css','browser-sync'], function() {
	gulp.watch(['./app/scss/**/*.scss'], ['sass']);
//	gulp.watch(['./app/js/**/*.js'], ['js']);
	gulp.watch(['./app/scss/*.css'], ['css']);
});