
// requires
var gulp        = require("gulp");
var sass        = require("gulp-sass");
var browserSync = require("browser-sync").create();

var autoprefixer = require("gulp-autoprefixer");
var plumber      = require("gulp-plumber");
var sourcemaps   = require('gulp-sourcemaps');


function mitypes_admin_sass_task(){

    return (
        gulp
        .src( ['./inc/admin/sass/*.scss','./inc/admin/sass/**/*.scss'] )
        .pipe( sass().on('error', sass.logError) )
        .pipe( gulp.dest('./inc/admin/css/') )
        .pipe( browserSync.stream() )
    );

}

function mitypes_admin_js_task(){

    return (
        gulp.task('js', function () {
            return gulp.src('./inc/admin/js/*js')
                // .pipe( browserify() )
                // .pipe( uglify() )
                .pipe(gulp.dest('./inc/admin/js/dist'));
        })
    );
}

function mitypes_admain_js_reload(){
    browserSync.reload();
    done();
}


function mitypes_launch(){
    
    browserSync.init({
      proxy: "https://mamp-sites.local/dev/menu-item-types/",
      // ghostMode: false,
      // open: false,
      // notify: false
    })

    // sass
    gulp.watch("./inc/admin/sass/*.scss", mitypes_admin_sass_task );
    gulp.watch("./inc/admin/sass/**/*.scss", mitypes_admin_sass_task );
    
    // js
    // gulp.watch("./inc/admin/js/*.js", mitypes_admin_js_task );
    gulp.watch("./inc/admin/js/*.js", mitypes_admain_js_reload );

    // php
    // gulp.watch("./*.php"   ).on('change', browserSync.reload);
    // gulp.watch("./**/*.php").on('change', browserSync.reload);

}

gulp.task('default', mitypes_launch );