const Encore = require("@symfony/webpack-encore");

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
	Encore.configureRuntimeEnvironment(process.env.NODE_ENV || "dev");
}

Encore
	// directory where compiled assets will be stored
	.setOutputPath("public/build/")
	// public path used by the web server to access the output path
	.setPublicPath("/build")
	// only needed for CDN's or subdirectory deploy
	//.setManifestKeyPrefix('build/')

	/*
	 * ENTRY CONFIG
	 *
	 * Each entry will result in one JavaScript file (e.g. app.js)
	 * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
	 */
	.addEntry("app", "./assets/app.js")
	// .addEntry("bootstrap", "./assets/bootstrap.js") // Add this line if you need Bootstrap
	.addEntry("test", "./assets/js/test.js")
	.addEntry("offcanvas", "./assets/js/offcanvas.js")
	.addEntry("app_css", "./assets/styles/app.css")
	.enableStimulusBridge("./assets/controllers/controllers.json") // Assurez-vous que ce chemin est correct
	.configureBabelPresetEnv((config) => {
		config.useBuiltIns = "usage"; // Ajoutez cette ligne si nécessaire
		config.corejs = 3; // Ajoutez cette ligne si nécessaire
	})
	.enableSourceMaps(!Encore.isProduction())
	.enableVersioning(Encore.isProduction())

	// When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
	.splitEntryChunks()

	// will require an extra script tag for runtime.js
	// but, you probably want this, unless you're building a single-page app
	.enableSingleRuntimeChunk()

	// pour Bootstrap
	Encore.enableSassLoader() 

	/*
	 * FEATURE CONFIG
	 *
	 * Enable & configure other features below. For a full
	 * list of features, see:
	 * https://symfony.com/doc/current/frontend.html#adding-more-features
	 */
	.cleanupOutputBeforeBuild()
	.enableBuildNotifications()
	.enableSourceMaps(!Encore.isProduction())
	// enables hashed filenames (e.g. app.abc123.css)
	.enableVersioning(Encore.isProduction())

	// configure Babel
	// .configureBabel((config) => {
	//     config.plugins.push('@babel/a-babel-plugin');
	// })

	// enables and configure @babel/preset-env polyfills
	.configureBabelPresetEnv((config) => {
		config.useBuiltIns = "usage";
		config.corejs = "3.38";
	});

// enables Sass/SCSS support
//.enableSassLoader()

// uncomment if you use TypeScript
//.enableTypeScriptLoader()

// uncomment if you use React
//.enableReactPreset()

// uncomment to get integrity="..." attributes on your script & link tags
// requires WebpackEncoreBundle 1.4 or higher
//.enableIntegrityHashes(Encore.isProduction())

// uncomment if you're having problems with a jQuery plugin
	Encore.autoProvidejQuery()

module.exports = Encore.getWebpackConfig();
