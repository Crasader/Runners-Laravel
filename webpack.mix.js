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

// Set the path to extract the lazy loaded js parts
mix.webpackConfig({
  output: {
    chunkFilename: 'js/[name].js'
  }
})

// Set the path to extract the vue components style
mix.options({
  // Extract here the components styles
  extractVueStyles: 'public/css/main.css'
  // The app vars to be injected in each components
  // globalVueSyles: 'resources/assets/vars.scss'
})

// SCSS extraction (from assets to public)
// JS extraction (from assets to public)... (extract to a separate file the js of libraries)
mix.js('resources/assets/main.js', 'js')
  // .sass('resources/assets/main.scss', 'css')
  .extract(['vue', 'vue-router', 'vuex', 'axios'])

// Create unique hash in production to force browser cache clearing
if (mix.inProduction()) {
  mix.version()
}
