var gulp = require('gulp'),
    concat = require('gulp-concat'),
    sourcemaps = require('gulp-sourcemaps'),
    minifyCss = require('gulp-clean-css'),
    addsrc = require('gulp-add-src'),
    uglify = require('gulp-uglify'),
    compass = require('gulp-compass'),
    jshint = require('gulp-jshint'),
    imagemin = require('gulp-imagemin')
    pngcrush = require('imagemin-pngcrush');

var src = {
  scripts: {
    dependencies: [
      'bower_components/jquery/dist/jquery.js',
      'bower_components/matchHeight/jquery.matchHeight-min.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/transition.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/alert.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/button.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/collapse.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/dropdown.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/modal.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/tooltip.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/popover.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/scrollspy.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/tab.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/affix.js',
      'bower_components/slick-carousel/slick/slick.js'
    ],
    custom: [
      'src/scripts/**/*.js',
      'src/scripts/main.js'
    ]
  },
  styles: {
    directory: 'src/styles',
    sass: 'src/styles/**/*.scss',
    dependencies: [
      './bower_components/bootstrap-sass-official/assets/stylesheets/',
      './bower_components/slick-carousel/slick'
    ]
  },
  images: [
    'bower_components/slick-carousel/slick/ajax-loader.gif',
    'src/images/**'
  ],
  fonts: [
    'bower_components/bootstrap-sass-official/assets/fonts/bootstrap/**',
    'bower_components/slick-carousel/slick/fonts/**'
  ]
};

var dest = {
  scripts: 'assets/scripts',
  styles: 'assets/styles',
  images: 'assets/images',
  fonts: 'assets/fonts'
}

/**
 * Scripts.check task: checks the custom JavaScript for any common errors.
 */
gulp.task('scripts.check', function() {

  return gulp
    .src(src.scripts.custom)
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(jshint.reporter('fail'));
});

/**
 *  Scripts task: concats and uglifies the JavaScript files with sourcemaps.
 */
gulp.task('scripts', ['scripts.check'], function() {
  
  return gulp
    .src(src.scripts.dependencies)
    .pipe(addsrc(src.scripts.custom))
    .pipe(sourcemaps.init())
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(dest.scripts));

});

/**
 * Fonts task: Move fonts from various bower folders and source folder to the assets folder.
 */
gulp.task('fonts', function() {

  return gulp
    .src(src.fonts)
    .pipe(gulp.dest(dest.fonts));

});

/**
 * Styles task: Generate the CSS and Sourcemap files and copy them to the assets folder.
 */
gulp.task('styles', ['fonts'], function() {

  return gulp
    .src(src.styles.sass)
    .pipe(compass({
      http_path: '/',
      sass: src.styles.directory,
      css: dest.styles,
      font: dest.fonts,
      image: dest.images,
      style: 'compressed',
      force: false,
      relative: true,
      sourcemap: false,
      import_path: src.styles.dependencies,
      require: 'breakpoint'
    }))
    .pipe(minifyCss())
    .pipe(gulp.dest(dest.styles));
  
});

/**
 * Images task: Optimize images and copy them over to the assets folder.
 */
gulp.task('images', function() {

  return gulp
    .src(src.images)
    .pipe(imagemin([pngcrush()]))
    .pipe(gulp.dest(dest.images));

})

/**
 * Watch task: watch for updates to the custom JavaScript files and the SASS files.
 */
gulp.task('watch', function() {
  gulp.watch(src.styles.sass, ['styles']);
  gulp.watch(src.scripts.custom, ['scripts']);
  gulp.watch(src.images, ['images']);
  gulp.watch(src.fonts, ['styles']);
});

/**
 * Build task: compiles all of the components to the assets folder.
 */
 gulp.task('build', ['scripts', 'styles', 'images']);

/**
 * Default task: runs a build and then watches for updates.
 */
 gulp.task('default', ['build', 'watch']);
