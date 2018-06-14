/**
 * Main js file for all pages
 */
import { FoldedBox } from './js/features/foldedBox'

// Event in the buger menu of the navbar
document.addEventListener('DOMContentLoaded', function () {
  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0)
  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {
    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {
        // Get the target from the "data-target" attribute
        var target = $el.dataset.target
        var $target = document.getElementById(target)

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active')
        $target.classList.toggle('is-active')
      })
    })
  }
})

// Register folded box component
// Scan the page and get all the serch fields
let foldedBoxes = document.querySelectorAll('[id^="unfolded-box-"]')

// Initialize all the search fields
for (let foldedBox of foldedBoxes) {
  let box = new FoldedBox(foldedBox)
  box.observe()
}
