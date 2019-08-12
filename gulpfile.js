const gulp=require('gulp'),
browserSync=require('browser-sync').create(),
sass=require('gulp-sass'),
webpback=require('webpack');


function copyStyles(){
  return gulp.src(['./node_modules/bootstrap/dist/css/bootstrap.css','./node_modules/font-awesome/css/font-awesome.css'])
  .pipe(gulp.dest('./styles'));
}


function copyScripts(){
  return gulp.src(['./node_modules/bootstrap/dist/js/bootstrap.js','./node_modules/popper.js/dist/popper.js','./node_modules/jquery/dist/jquery.js'])
  .pipe(gulp.dest('./scripts'));
}


function sassToCss(){
  return gulp.src('./scss/**/*.scss')
  .pipe(sass().on('error', sass.logError))
  .pipe(gulp.dest('./styles'))
  .pipe(browserSync.stream());
}


function scripts() {
    webpback(require('./webpack.config'),function (error,stats) {
        if (error) {
            console.log(error);
        }
        console.log(stats.toString());
    });
}


function watchStylesScripts(){
  gulp.watch('./scss/**/*.scss',sassToCss);
  gulp.watch('./scripts/temp/**/*.js',scripts);
}




gulp.task('default',gulp.parallel(copyStyles,copyScripts,watchStylesScripts));