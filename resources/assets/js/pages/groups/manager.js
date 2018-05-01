/**
* Script fot the groups manager page
*
* @author Bastien Nicoud
*/

// Import the library to simply sort the elements
import Sortable from 'sortablejs'

console.log('SORTABLE')

// Get all the groups elements on the page
let elements = document.querySelectorAll('[id^="group"]')

// Create the sortable instance
for (let el of elements) {
  Sortable.create(el, {
    group: 'manager',
    animation: 100,
    // On each drag n drop function
    onEnd: function (event) {
      // We change the value of the input of the user to match his new group
      // We get the id of the new group
      let newGroup = event.to.getAttribute('data-group-id')
      // Get the element dragged
      let element = event.item.getElementsByTagName('input')[0]
      // Gets the id of the user coresponding to this element
      let userId = element.getAttribute('data-user-id')
      // Sets the new group id
      element.setAttribute('value', newGroup)
      // Change the input name for the form submission
      element.setAttribute('name', `user[${userId}]`)
    }
  })
}
