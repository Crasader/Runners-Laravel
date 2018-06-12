/**
 * Main js file for all pages
 */
import { FoldedBox } from './js/features/foldedBox'

console.log('TUTU')

// Register folded box component

// Scan the page and get all the serch fields
let foldedBoxes = document.querySelectorAll('[id^="unfolded-box-"]')

// Initialize all the search fields
for (let foldedBox of foldedBoxes) {
  let box = new FoldedBox(foldedBox)
  box.observe()
}
