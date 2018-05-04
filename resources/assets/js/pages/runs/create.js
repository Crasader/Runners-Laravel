/**
* Script fot the runs creation page
*
* @author Bastien Nicoud
*/

console.log('RUNS CREATE')

// ads new waypoint field when click on plus button
document.getElementById('add-waypoint').addEventListener('click', (e) => {
  e.preventDefault()
  console.log(e)
  console.log(e.target.getAttribute('data-waypoint-index'))
})
