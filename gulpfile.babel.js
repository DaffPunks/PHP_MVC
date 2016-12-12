'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const babel = require('gulp-babel');

gulp.task('sass', function () {
    gulp.src('./resources/assets/sass/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('css/'));
});

gulp.task('js', () => {
    return gulp.src('./resources/assets/js/*.js')
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(gulp.dest('js/'));
});

gulp.task('sass:watch', function () {
    gulp.watch(['./resources/assets/sass/*.scss', './resources/assets/sass/*/*.scss'], ['sass']);
});

gulp.task('js:watch', function () {
    gulp.watch(['./resources/assets/js/*.js'], ['js']);
});

gulp.task('watch', function () {
    gulp.watch(['./resources/assets/js/*.js','./resources/assets/sass/*.scss', './resources/assets/sass/*/*.scss'], ['js','sass']);
});

gulp.task('npm', function () {
    gulp.src([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/bootstrap/dist/css/bootstrap-theme.min.css',
        ])
        .pipe(gulp.dest('css/'));
    gulp.src([
        'node_modules/jquery/dist/jquery.min.js'
    ])
        .pipe(gulp.dest('js/'))
});