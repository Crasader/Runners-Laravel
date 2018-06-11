/**
* Script fot the runs creation page
*
* @author Bastien Nicoud
*/
import { SearchField } from '../../features/searchField'

console.log('RUNS CREATE')

// Scan the page and get all the serch fields
let fields = document.querySelectorAll('[id^="search-input-"]')

// Initialize all the search fields
for (let el of fields) {
  let field = new SearchField()
  field.observe(el)
}
