var gulp = require('gulp');
var minifycss = require('gulp-minify-css');

gulp.task('css', function() {
    return gulp.src([
        'node_modules/bootstrap/dist/css/bootstrap.css',
        'node_modules/font-awesome/css/font-awesome.min.css',
        'vendor/sb/blog-post.css'
        ])
        .pipe(minifycss())
        .pipe(gulp.dest('dist/css'));
});

gulp.task('default', function() {
    gulp.run('css');
});
