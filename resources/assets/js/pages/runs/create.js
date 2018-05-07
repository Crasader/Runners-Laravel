/**
* Script fot the runs creation page
*
* @author Bastien Nicoud
*/

console.log('RUNS CREATE')

let observeNewWaypoint = function (element) {
  console.log(`Observe waypoint : ${element.id}`)
  element.addEventListener('click', (e) => {
    e.preventDefault()
    console.log(e)
  })
}

// Select all the buttons to add waypoints
let waypointsAddButtons = document.querySelectorAll('[id^="add-waypoint-"]')

// Initialize all observers
for (let waypointAddButton of waypointsAddButtons) {
  observeNewWaypoint(waypointAddButton)
}
