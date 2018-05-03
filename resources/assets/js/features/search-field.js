/**
* Script fot the search fields with autocomplete
* If you use the search field component (components/horizontal_search_input.blade.php)
* You need to include this script to work properly
*
* !! WARNING !! The search fields dosen't use api routes, because is not the same authentication system
*
* @author Bastien Nicoud
*/

console.log('SEARCH FIELD AUTOCOMPLETE')

// Scan the page and get all the serch fields
let searchFields = document.querySelectorAll('[id^="search-field-"]')

// Initialize all the search fields
for (let searchField of searchFields) {
  console.log(searchField.name)
  console.log(searchField.getAttribute('data-search-api-url'))

  searchField.addEventListener('input', (e) => {
    console.log('Input')
    console.log(e)
  })
}
