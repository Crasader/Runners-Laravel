let mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | This file describe the assets to compile
 | The assets are located in the ressources/assets
 | Mix use webpack to compile the assets
 | See the package.json to see all the available build commands
 |
 */

mix.disableNotifications()

mix.js('resources/assets/app.js', 'public/js')
