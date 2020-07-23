

'use strict';

var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    notify = require("gulp-notify"),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    // mqpacker = require('css-mqpacker'),
    cssnano = require('cssnano');

var path = {
    build: {
        css: 'css'
    },
    src: {
        style: 'sass/additional.scss',
    },
    watch: {
        style: 'sass/**/*.scss',
    },
};


function css(callback) {
    gulp.src(path.src.style)
        .pipe(sourcemaps.init())
        .pipe(plumber({
            errorHandler: notify.onError(
                "\nError in file : <%= error.fileName%>\nLine: <%= error.lineNumber %>\nError message: <%= error.message %>"
            )
        }))
        .pipe(sass().on('error', sass.logError))
        // .pipe(postcss([autoprefixer({ browsers: ['> 1%', 'last 3 versions', 'Firefox >= 20', 'iOS >=7'] }), mqpacker({ sort: false }), cssnano()]))
        .pipe(postcss([autoprefixer({ overrideBrowserslist: ['> 1%', 'last 3 versions', 'Firefox >= 20', 'iOS >=7'] }), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(path.build.css))
        .pipe(notify({
            "title": "Gulp Task Complete",
            "message": "Success SASS compiled"}));
    callback();
}

function watch_files(callback) {
    gulp.watch([path.watch.style], css);
    callback();
}

// gulp.task('css', css);

gulp.task('default', gulp.series(css, watch_files));