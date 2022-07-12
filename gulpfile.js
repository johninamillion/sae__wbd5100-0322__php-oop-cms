(function(){

    'use strict';

    const gulp          = require( 'gulp' );
    const sass          = require( 'gulp-sass' )( require( 'sass' ) );
    const autoprefixer  = require( 'gulp-autoprefixer' );

    function compileSCSS() {
        return gulp.src( './public/assets/src/scss/**/*.scss' )
            .pipe( sass().on( 'error', sass.logError ) )
            .pipe( autoprefixer() )
            .pipe( gulp.dest( './public/assets/dist/css' ) );
    }

    function watchSCSS() {
        gulp.watch( './public/assets/src/scss/**/*.scss', gulp.series( compileSCSS ) );
    }

    exports.compileSCSS = compileSCSS;
    exports.watchSCSS = watchSCSS;

    exports.build = gulp.series( compileSCSS );

})();