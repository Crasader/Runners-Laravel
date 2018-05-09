/**
* Script fot the runs creation page
*
* @author Bastien Nicoud
*/
import { WaypointField } from '../../features/waypointField'
import { SearchField } from '../../features/searchField'

console.log('RUNS CREATE')

// Select all the buttons to add waypoints
let waypointsAddButtons = document.querySelectorAll('[id^="add-waypoint-"]')

// Initialize all observers (for the waypoints fields)
for (let waypointAddButton of waypointsAddButtons) {
  let waypointField = new WaypointField(waypointAddButton)
  waypointField.observe()
}

// Scan the page and get all the serch fields
let fields = document.querySelectorAll('[id^="search-input-"]')

// Initialize all the search fields
for (let el of fields) {
  let field = new SearchField()
  field.observe(el)
}
