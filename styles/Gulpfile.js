var gulp = require('gulp');
var sass = require('gulp-sass');

var styleExpanded = {
    errLogToConsole: true,
    outputStyle: 'expanded',
    precision: 8
};

var styleCompressed = {
    errLogToConsole: true,
    outputStyle: 'compressed',
    precision: 8
};
gulp.task('styless', function() {
    return gulp.src('HomePage.scss')
        .pipe(sass(styleExpanded))
        .on('error', sass.logError)
        .pipe(gulp.dest('./css'))
});
