import gulp from 'gulp';
import {
	stylesFront,
	stylesAdmin,
	scriptsFront,
	scriptsAdmin,
	isDeploy,
	images,
	fonts,
	cleanAssets, stylesElementor, scriptsElementor,
} from './tasks.js';
import when from 'gulp-if';

// Watch

export const watch = () => {
	gulp.watch( 'styles/front/**/*.*', gulp.series( stylesFront ) );
	gulp.watch( 'styles/admin/**/*.*', gulp.series( stylesAdmin ) );
	gulp.watch( 'styles/elementor/**/*.*', gulp.series( stylesElementor ) );
	gulp.watch( 'scripts/front/**/*.*', gulp.series( scriptsFront ) );
	gulp.watch( 'scripts/admin/**/*.*', gulp.series( scriptsAdmin ) );
	gulp.watch( 'scripts/elementor/**/*.*', gulp.series( scriptsElementor ) );
	gulp.watch( 'img/**/*.{jpg,jpeg,png,webp,svg,gif}', images );
	gulp.watch( 'fonts/**/*.{woff,woff2}', fonts );
};

// Default

export default gulp.series(
	cleanAssets,
	gulp.parallel(
		stylesFront,
		stylesAdmin,
		stylesElementor,
		scriptsFront,
		scriptsAdmin,
		scriptsElementor,
		fonts,
		images,
	),
	watch
);

// build

export const build = gulp.series(
	cleanAssets,
	gulp.parallel(
		stylesFront,
		stylesAdmin,
		stylesElementor,
		scriptsFront,
		scriptsAdmin,
		scriptsElementor,
		fonts,
		images,
	)
);
