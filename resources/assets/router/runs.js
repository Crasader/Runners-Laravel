/**
 * Runs routes
 *
 * All the routes for the run crud
 *
 * @author Bastien Nicoud
 */

// Conponents imports
import RunsList from '../views/Runs/RunsList.vue'

// Routes declarations
export default [
  // Runs
  {
    path: 'runs',
    name: 'runs-list',
    component: RunsList
  }
]
