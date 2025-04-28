const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');

// File paths
const paths = {
    scss: './src/scss/**/*.scss', // Source SCSS files
    js: './src/js/**/*.js',       // Source JavaScript files
    cssOutput: '../public/dist/css',   // Output folder for CSS (relative to resources)
    jsOutput: '../public/dist/js',     // Output folder for JavaScript (relative to resources)
    vendorOutputJS: '../public/dist/vendor/js', // Output folder for vendor libraries (relative to resources)
    vendorOutputCSS: '../public/dist/vendor/css', // Output folder for vendor libraries (relative to resources)
};

// Compile SCSS to CSS
function compileSCSS() {
    return gulp
        .src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', function (err) {
            console.error(err.message); // Log the error
            this.emit('end'); // Prevent Gulp from stopping
        }))
        .pipe(postcss([autoprefixer()]))
        .pipe(cleanCSS())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.cssOutput));
}

// Minify and Process Each JavaScript File Individually
function minifyJS() {
    return gulp
        .src(paths.js)
        .pipe(sourcemaps.init())
        .pipe(uglify().on('error', function (err) {
            console.error(err.message); // Log the error
            this.emit('end'); // Prevent Gulp from stopping
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.jsOutput)); // Output each file individually
}

// Copy and Minify Vendor Libraries
function copyVendors() {
    // Alpine.js
    gulp.src('./node_modules/alpinejs/dist/cdn.min.js')
        .pipe(gulp.dest(paths.vendorOutputJS));

    // jQuery
    gulp.src('./node_modules/jquery/dist/jquery.min.js')
        .pipe(gulp.dest(paths.vendorOutputJS));

    // Floating UI (UMD version)
    gulp.src('./node_modules/@floating-ui/dom/dist/floating-ui.dom.umd.min.js')
        .pipe(gulp.dest(paths.vendorOutputJS));
        
    gulp.src('./node_modules/sweetalert2/dist/sweetalert2.all.min.js')
        .pipe(gulp.dest(paths.vendorOutputJS));

    gulp.src('./node_modules/sweetalert2/dist/sweetalert2.min.css')
        .pipe(gulp.dest(paths.vendorOutputCSS));

    return Promise.resolve(); // Ensure the task completes
}

// Watch for changes
function watchFiles() {
    gulp.watch(paths.scss, compileSCSS);
    gulp.watch(paths.js, minifyJS);
}

// Define tasks
exports.scss = compileSCSS;
exports.js = minifyJS;
exports.vendors = copyVendors;
exports.watch = gulp.series(compileSCSS, minifyJS, copyVendors, watchFiles);
exports.default = gulp.series(compileSCSS, minifyJS, copyVendors);