/*
 |--------------------------------------------------------------------------
 | Errors and redirect routes
 |--------------------------------------------------------------------------
 |
 | Register global routes to cover errors and not founds
 | @author Bastien Nicoud
 |
 */

export default [
  // Redirect to homepage for inexitant routes
  {
    path: '*',
    redirect: '/'
  }
]
