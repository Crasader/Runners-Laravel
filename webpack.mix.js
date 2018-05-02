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

// SCSS extraction (from assets to public)
// JS extraction (from assets to public)... (extract to a separate file the js of libraries)
mix
  .js('resources/assets/main.js', 'js')
  .js('resources/assets/js/pages/users/edit.js', 'js/pages/users')
  .js('resources/assets/js/pages/groups/manager.js', 'js/pages/groups')
  .js('resources/assets/js/pages/runs/create.js', 'js/pages/runs')
  .sass('resources/assets/main.scss', 'css')

// Create unique hash in production to force browser cache clearing
if (mix.inProduction()) {
  mix.version()
}
