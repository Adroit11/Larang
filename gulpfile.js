var gulp 	= require('gulp'),
	uglify	= require('gulp-uglify'),
	sass	= require('gulp-ruby-sass'),
	concat	= require('gulp-concat'),
	minify	= require('gulp-clean-css'),
	jshint	= require('gulp-jshint'),
	prefix	= require('gulp-autoprefixer');


//Display error messages 
function errorLog(error)
{
	console.error.bind(error);
	this.emit('end');
}


//scriptLibs Task
//Concat and uglify script libraries
gulp.task('scriptLibs', function(){
	gulp.src([
		'bower_components/angular/angular.js',
		'bower_components/angular-bootstrap/ui-bootstrap-tpls.js', 
		'bower_components/angular-resource/angular-resource.js',
		'bower_components/moment/moment.js'])
	.pipe(uglify())
	.pipe(concat('libs.js'))
	.pipe(gulp.dest('public/js/'));

});

//scriptLibs Task
//Concat and uglify script libraries
gulp.task('script', function(){
	gulp.src([
		'resources/scripts/app.js',
		'resources/scripts/controllers/TimeEntry.js',
		'resources/scripts/services/time.js',
		'resources/scripts/services/user.js'])	
	.pipe(uglify({mangle: false}))
	.pipe(concat('app.js'))
	.pipe(gulp.dest('public/js/'));

});

//lint Task
//Lint js
gulp.task('lint', function(){
	gulp.src([
		'resources/scripts/app.js',
		'resources/scripts/controllers/TimeEntry.js',
		'resources/scripts/services/time.js',
		'resources/scripts/services/user.js'])
	.pipe(jshint())
  	.pipe(jshint.reporter('jshint-stylish'))
  	.pipe(jshint.reporter('fail'))
  	.on('error', errorLog);
});



gulp.task('cssLibs', function(){
	gulp.src([
		'bower_components/bootstrap/dist/css/bootstrap.css'
		])
	.pipe(minify())
	.pipe(concat('libs.css'))
	.pipe(gulp.dest('public/css'));

});


gulp.task('sass', function(){
	return sass('resources/assets/sass/app.scss', { style: 'compressed' })
	.on('error', errorLog)
	.pipe(prefix('last 2 versions'))
	.pipe(gulp.dest('public/css/'));
});


gulp.task('watch', function(){
	gulp.watch('resources/assets/sass/app.scss', ['sass']);
	gulp.watch('resources/scripts/app.js', ['script']);
	gulp.watch('resources/scripts/controllers/TimeEntry.js', ['script']);
	gulp.watch('resources/scripts/services/time.js', ['script']);
	gulp.watch('resources/scripts/services/user.js', ['script']);
});

gulp.task('default', ['scriptLibs','cssLibs', 'watch']);