var gulp			= require('gulp'),
	fs			= require('fs'),
	autoprefixer	= require('gulp-autoprefixer'),
	concat		= require('gulp-concat'),
	cssmin		= require('gulp-cssnano'),
	sass			= require('gulp-sass'),
	rename		= require("gulp-rename"),
	jshint		= require('gulp-jshint'),
	stylish		= require('jshint-stylish'),
	uglify		= require('gulp-uglify'),
	babel			= require('gulp-babel'),
	imagemin		= require('gulp-imagemin'),
	browserSync 	= require('browser-sync').create(),
	config		= {
		siteRoot: "localhost" // override in config.json (see sample-config.json for example)
	};

if (fs.existsSync('config.json')) {
	config = JSON.parse(fs.readFileSync('config.json'));
}

gulp.task('sass', function () {
	gulp.src('./assets/scss/*.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(autoprefixer({
		browsers: [
		 	'last 3 versions',
		],
		cascade: false
	}))
	.pipe(cssmin({
            discardComments: {removeAll: true}
      }))
	.pipe(gulp.dest('./public/css/'))
	.pipe(browserSync.stream());
});

gulp.task('js', function(){
	console.log('Starting JS');
	gulp.src(['./node_modules/bootstrap/dist/js/bootstrap.bundle.js', './assets/js/*'])
		.pipe(jshint())
		.pipe(jshint.reporter(stylish))
		.pipe(uglify())
		.pipe(concat('init.min.js'))
		.pipe(gulp.dest('./public/js'));
});

gulp.task('jsinline', function(){
	gulp.src('./assets/js-inline/*.js')
		.pipe(jshint())
		.pipe(babel({
			presets: ['es2015']
		}))
		.pipe(uglify())
		.pipe(gulp.dest('public/js'));
});

gulp.task('images', function() {
	return gulp.src('./assets/images/**/*')
		.pipe(imagemin({
			progressive: true,
			interlaced: true,
			svgoPlugins: [{removeUnknownsAndDefaults: false}, {cleanupIDs: false}]
		}))
		.pipe(gulp.dest('./public/images'));
});

gulp.task('bs-js', ['js'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('bs-jsinline', ['jsinline'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('bs-imgs', ['images'],  function (done) {
	browserSync.reload();
	done();
});

gulp.task('bs-php', function (done) {
	browserSync.reload();
	done();
})

gulp.task('default', function () {
	browserSync.init({
		proxy: config.siteRoot
	});
	gulp.watch('./assets/scss/**/*.scss', ['sass']);
	gulp.watch('./assets/js/**/*.js', ['bs-js']);
	gulp.watch('./assets/js-inline/*.js', ['bs-jsinline']);
	gulp.watch('./assets/images/**/*', ['bs-imgs']);
	gulp.watch('./**/*.php', ['bs-php']);
});
