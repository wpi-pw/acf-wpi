const mix = require('laravel-mix');
const modulesPath = 'lib/modules';
require('dotenv').config({path: '../../../../.env'}); //GET .env
const ACF_MODULES = process.env.ACF_MODULES; // Get ACF_MODULES variable from env. This variable contains all project modules e.g.: "acf_event,acf_intl_tel"
const modules = ACF_MODULES ? ACF_MODULES.split(',') : ['acf_event']; // Split modules string if exist or use pre-set Array

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
mix.setPublicPath("./");

if(mix.inProduction()) {
	mix.options({
		terser: {
			terserOptions: {
				compress: {
					drop_console: true
				}
			}
		}
	});
}

mix.webpackConfig({
	resolve: {
		modules: [
			'node_modules', 'src/scripts/helpers', 'src/styles'
		],
		enforceExtension: false
	},
	externals: {
		jquery: 'jQuery'
	}
});

mix.js('src/scripts/admin.js', 'dist/')
	.js('src/scripts/main.js','dist/')
	.sass('src/styles/admin.scss', 'dist/')
	.sass('src/styles/main.scss', 'dist/')
	.options({processCssUrls: false})
	.copyDirectory('src/fonts', 'dist/fonts')
	.copyDirectory('src/images', 'dist/images');

// Add each modules assets build
modules.forEach(function (module) {
	mix
		.js(`${modulesPath}/${module}/src/scripts/script.js`,`${modulesPath}/${module}/`)
		.sass(`${modulesPath}/${module}/src/styles/style.scss`,`${modulesPath}/${module}/`).options({processCssUrls: false});
});

mix.browserSync({
	proxy: 'http://acf.test',
	delay: 500,
	open: false,
	files: [
		'dist/*.js',
		'dist/*.css',
		'lib/modules/**/*.js',
		'lib/modules/**/*.css'
	]
});

mix.disableNotifications();

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.ts(src, output); <-- Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.standaloneSass('src', output); <-- Faster, but isolated from Webpack.
// mix.fastSass('src', output); <-- Alias for mix.standaloneSass().
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.dev');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });

