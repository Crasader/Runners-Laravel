/**
* Script fot the groups manager page
*
* @author Bastien Nicoud
*/

// Import the library to simply sort the elements
import Sortable from 'sortablejs'

// Get all the groups elements on the page
let elements = document.querySelectorAll('[id^="group"]')

// Create the sortable instance
for (let el of elements) {
  Sortable.create(el, {
    group: 'manager',
    animation: 100
  })
}
