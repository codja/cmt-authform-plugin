import gulp         from 'gulp';
import sass         from 'gulp-sass';
import rename       from 'gulp-rename';
import sassglob	    from 'gulp-sass-glob';
import cleancss     from 'gulp-clean-css';
import gcmq         from 'gulp-group-css-media-queries';
import autoprefixer from 'gulp-autoprefixer';
import sftp         from 'gulp-sftp-up4';
import del          from 'del';
import webpack      from 'webpack-stream';
import when         from 'gulp-if';
import uglifyim     from 'gulp-uglify-es'
const  uglify       = uglifyim.default
import { env }      from './env.js';

const mode = process.env.MODE;
export const isDeploy = mode === 'deploy';
const destDir = 'assets';

const styles = ( srcPath, destPath, remotePath ) => {
	return gulp
		.src( srcPath )
		.pipe( sassglob() )
		.pipe( sass() )
		.pipe( rename( { suffix: '.min', prefix: '' } ) )
		.pipe(
			autoprefixer( {
				overrideBrowserslist: [ 'last 10 versions' ],
				grid: true,
			} )
		)
		.pipe( gcmq() )
		.pipe(
			cleancss( {
				level: {
					1: { specialComments: 0 },
				} /* format: 'beautify' */,
			} )
		)
		.pipe( gulp.dest( destPath ) )
		.pipe(
			when(
				isDeploy,
				sftp( {
					host: env.ftp.host,
					user: env.ftp.user,
					pass: env.ftp.password,
					remotePath, // need create directory on server
				} )
			)
		);
};

export const stylesAdmin = () => {
	return styles(
		[ `styles/admin/*.*`, `!styles/admin/_*.*` ],
		`../${ destDir }/css/admin`,
		`${ env.remotePath }/${ destDir }/css/admin`
	);
};

export const stylesFront = () => {
	return styles(
		[ `styles/front/*.*`, `!styles/front/_*.*` ],
		`../${ destDir }/css/front`,
		`${ env.remotePath }/${ destDir }/css/front`
	);
};

export const stylesElementor = () => {
	return styles(
		[ `styles/elementor/*.*`, `!styles/elementor/_*.*` ],
		`../${ destDir }/css/elementor`,
		`${ env.remotePath }/${ destDir }/css/elementor`
	);
};

export const scripts = ( srcPath, destPath, remotePath, fileName = 'rgbcode-authform' ) => {
	return gulp
		.src( srcPath )
		.pipe(
			webpack( {
				mode: 'production',
				devtool: false,
				module: {
					rules: [
						{
							test: /\.(js)$/,
							exclude: /(node_modules)/,
							loader: 'babel-loader',
							query: {
								presets: [ '@babel/env' ],
								plugins: [ 'babel-plugin-root-import' ],
							},
						},
					],
				},
			} )
		)
		.on( 'error', function handleError() {
			this.emit( 'end' );
		} )
		.pipe( rename( `${ fileName }.min.js` ) )
		.pipe( gulp.dest( destPath ) )
		.pipe(
			when(
				isDeploy,
				sftp( {
					host: env.ftp.host,
					user: env.ftp.user,
					pass: env.ftp.password,
					remotePath, // need create directory on server
				} )
			)
		);
};

export const scriptsAdmin = () => {
	return scripts(
		[ `scripts/admin/*.*`, `!scripts/admin/_*.*` ],
		`../${ destDir }/js/admin`,
		`${ env.remotePath }/${ destDir }/js/admin`
	);
};

export const scriptsFront = () => {
	return scripts(
		[ `scripts/front/*.*`, `!scripts/front/_*.*` ],
		`../${ destDir }/js/front`,
		`${ env.remotePath }/${ destDir }/js/front`
	);
};

export const scriptsElementor = () => {
	const remotePath = `${ env.remotePath }/${ destDir }/js/elementor`;
	return gulp
		.src( [ `scripts/elementor/*.*` ] )
		.pipe( uglify() )
		.pipe( gulp.dest( `../${ destDir }/js/elementor` ) )
		.pipe(
			when(
				isDeploy,
				sftp( {
					host: env.ftp.host,
					user: env.ftp.user,
					pass: env.ftp.password,
					remotePath, // need create directory on server
				} )
			)
		);
};

export const images = () => {
	return gulp
		.src( [ 'img/**/*' ] )
		// .pipe( imagemin() )
		.pipe( gulp.dest( `../${ destDir }/img/` ) );
};

export const fonts = () => {
	return gulp
		.src( [ 'fonts/**/*' ], {
			base: 'src/',
		} )
		.pipe( gulp.dest( `../${ destDir }/fonts/` ) );
};

export const cleanAssets = () => {
	return del( `../${ destDir }/**/*`, { force: true } );
};
