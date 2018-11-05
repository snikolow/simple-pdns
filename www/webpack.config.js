var Encore = require('@symfony/webpack-encore');
var CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/custom', './assets/js/custom.js')
    .addEntry('js/sidebarmenu', './assets/js/sidebarmenu.js')
    .addEntry('js/waves', './assets/js/waves.js')
    .addStyleEntry('css/app', './assets/sass/style.scss')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .autoProvidejQuery()
    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/images', to: 'images' }
    ]))
;

module.exports = Encore.getWebpackConfig();
