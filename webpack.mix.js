let mix = require('laravel-mix');
mix.js('resources/js/app.js', 'public/js')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve('resources/js')
            },
            modules: [
                path.resolve(__dirname, 'node_modules')
            ]
        }
    });
