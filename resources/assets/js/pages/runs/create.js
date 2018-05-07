/**
* Script fot the runs creation page
*
* @author Bastien Nicoud
*/
import { observeNewWaypoint } from '../../features/waypointsFields'
import { SearchField } from '../../features/searchField'

console.log('RUNS CREATE')

// Select all the buttons to add waypoints
let waypointsAddButtons = document.querySelectorAll('[id^="add-waypoint-"]')

// Initialize all observers
for (let waypointAddButton of waypointsAddButtons) {
  observeNewWaypoint(waypointAddButton)
}

// Scan the page and get all the serch fields
let searchFields = document.querySelectorAll('[id^="search-input-"]')

// Initialize all the search fields
for (let el of searchFields) {
  SearchField.observe(el)
}
