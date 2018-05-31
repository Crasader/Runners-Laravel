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
  // MAIN
  .js('resources/assets/main.js', 'js')
  // PAGES
  .js('resources/assets/js/pages/users/edit.js', 'js/pages/users')
  .js('resources/assets/js/pages/groups/manager.js', 'js/pages/groups')
  .js('resources/assets/js/pages/runs/create.js', 'js/pages/runs')
  .js('resources/assets/js/pages/schedules/index.js', 'js/pages/schedules')
  .js('resources/assets/js/pages/runs/big.js', 'js/pages/runs')
  // FUNCTIONALITIES
  .js('resources/assets/js/features/filters.js')
  // SCSS
  .sass('resources/assets/main.scss', 'css')
  .sass('resources/assets/scss/pages/big_runs.scss', 'css')
  .copy('node_modules/fullcalendar/dist/fullcalendar.min.css', 'public/css/calendar/fullcalendar.css')

// Create unique hash in production to force browser cache clearing
if (mix.inProduction()) {
  mix.version()
}
