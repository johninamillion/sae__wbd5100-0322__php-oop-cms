(function(){

    'use strict';

    const gulp          = require( 'gulp' );
    const sass          = require( 'gulp-sass' )( require( 'sass' ) );
    const autoprefix    = require( 'gulp-autoprefixer' );
    const minify        = require( 'gulp-clean-css' );
    const rename        = require( 'gulp-rename' );

    function compileSCSS() {
        return gulp.src( './public/assets/src/scss/**/*.scss' )
            .pipe( sass().on( 'error', sass.logError ) )
            .pipe( autoprefix() )
            .pipe( gulp.dest( './public/assets/dist/css' ) )
            .pipe( minify() )
            .pipe( rename( { suffix: '.min' } ) )
            .pipe( gulp.dest( './public/assets/dist/css' ) );
    }

    function watchSCSS() {
        gulp.watch( './public/assets/src/scss/**/*.scss', gulp.series( compileSCSS ) );
    }

    exports.compileSCSS = compileSCSS;
    exports.watchSCSS = watchSCSS;

    exports.build = gulp.series( compileSCSS );

})();