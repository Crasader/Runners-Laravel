/**
* Script fot the runs creation page
*
* @author Bastien Nicoud
*/
import { SearchField } from '../../features/searchField'

// Scan the page and get all the serch fields
let fields = document.querySelectorAll('[id^="search-input-"]')

// Initialize all the search fields
for (let el of fields) {
  let field = new SearchField(el)
  field.observe()
}
