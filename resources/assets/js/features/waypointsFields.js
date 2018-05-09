/**
* Script fot the runs creation page
*
* @author Bastien Nicoud
*/

export function observeNewWaypoint (element) {
  console.log(`Observe waypoint : ${element.id}`)
  element.addEventListener('click', (e) => {
    e.preventDefault()
    console.log(e)
  })
}
