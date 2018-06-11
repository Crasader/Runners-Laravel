/**
* Script fot the search fields with autocomplete
* If you use the search field component (components/horizontal_search_input.blade.php)
* You need to include this script to work properly
*
* !! WARNING !! The search fields dosen't use api routes, because is not the same authentication system
*
* TODO:
* - Rewrite the modue more "object oriented"
*
* @author Bastien Nicoud
*/
export class SearchField {
  /**
   * Class constructor
   * @param {*} field
   */
  constructor (field) {
    console.log('SEARCH FIELD INSERTED')
    /**
     * The field who want autocomplete
     */
    this.field = field
    /**
     * Get the url to search autocomplete (stored in a data property)
     */
    this.searchApiUrl = field.getAttribute('data-search-api-url')
    /**
     * The box where the results could apear
     */
    this.resultsBox = document.getElementById(`search-field-${field.name}`)
  }
  /**
   * Launch the triggers for the search actions
   *
   * @param {Element} searchField The fiels on wich to graft the search
   */
  observe () {
    // Hook events on each search fields
    this.field.addEventListener('input', (e) => {
      let el = e.target
      let resultEl = document.getElementById(`search-field-${el.name}`)
      let apiUrl = el.getAttribute('data-search-api-url')

      if (e.data !== null) {
        this.search(apiUrl, el.value).then((datas) => {
          if (document.getElementById(`search-results-${el.name}`)) {
            document.getElementById(`search-results-${el.name}`).remove()
          }

          if (datas.length !== 0) {
            let content = document.createElement('div')
            content.className = 'dropdown-content'

            for (let result of datas) {
              let resultElement = document.createElement('div')
              resultElement.className = 'dropdown-item'
              resultElement.innerHTML = result.name
              content.appendChild(resultElement)
            }

            let results = document.createElement('div')
            results.className = 'dropdown-menu'
            results.id = `search-results-${el.name}`
            results.appendChild(content)

            resultEl.appendChild(results)

            for (let searchResult of content.children) {
              searchResult.addEventListener('click', (e) => {
                document.getElementById(`search-input-${el.name}`).value = e.target.innerText
                document.getElementById(`search-results-${el.name}`).remove()
              })
            }
          }
        })
      } else {
        if (document.getElementById(`search-results-${el.name}`)) {
          document.getElementById(`search-results-${el.name}`).remove()
        }
      }

      this.field.addEventListener('keyup', e => {
        console.log('KEYPRESS', e.keyCode)
        e.preventDefault()
        e.stopPropagation()

        // ESCAPE to exit the field
        if (e.keyCode === 27) {
          console.log('ESCAPE PRESSED')
          this.field.value = ''
          if (document.getElementById(`search-results-${el.name}`)) {
            document.getElementById(`search-results-${el.name}`).remove()
          }
        }
        // TAB to insert the value and go to the next field
        if (e.keyCode === 9) {
          console.log('TAB PRESSED')
          //
        }
        // ARROW DOWN
        if (e.keyCode === 40) {
          console.log('ARROW DOWN PRESSED')
          //
        }
        // ARROW UP
        if (e.keyCode === 38) {
          console.log('ARROW UP PRESSED')
          //
        }
        // Enter add the curent selected to the field
        if (e.keyCode === 13) {
          console.log('ENTER PRESSED')
          //
        }
      })
    })
  }

  /**
   * Make the call to the server to gets the results
   * @param {string} apiUrl The url to the api
   * @param {string} needle The needle to pass in the query
   */
  search (apiUrl, needle) {
    return new Promise((resolve, reject) => {
      fetch(apiUrl, {
        method: 'post',
        credentials: 'same-origin',
        headers: {
          'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
          'X-Requested-With': 'XMLHttpRequest',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          needle: needle
        })
      })
        .then((response) => response.json())
        .then((datas) => resolve(datas))
        .catch((error) => reject(error))
    })
  }
}
