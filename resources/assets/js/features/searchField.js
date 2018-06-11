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
    this.currentSelected = 'none'
  }
  /**
   * Launch the triggers for the search actions
   *
   * @param {Element} searchField The fiels on wich to graft the search
   */
  observe () {
    console.log('SEARCH FIELD OBSERVER LAUNCH')
    // Register listeners on keys (for control actions)
    this.registerListeners()
    // Hook events on each search fields
    this.field.addEventListener('input', (e) => {
      if (e.data !== null) {
        // Make the api call to get sugestions
        this.search(this.field.value).then(() => {
          this.render()
        })
      } else {
        if (this.field.value === '') {
          this.searchResults = null
          this.render()
        } else {
          this.search(this.field.value).then(() => {
            this.render()
          })
        }
      }
    })
  }

  /**
   * Attach events to keys
   */
  registerListeners () {
    this.field.addEventListener('keydown', e => {
      console.log('KEYPRESS', e.keyCode)

      // ESCAPE to exit the field
      if (e.keyCode === 27) {
        console.log('ESCAPE PRESSED')
        this.field.value = ''
        if (document.getElementById(`search-results-${this.field.name}`)) {
          document.getElementById(`search-results-${this.field.name}`).remove()
        }
      }
      // TAB to insert the value and go to the next field
      if (e.keyCode === 9) {
        console.log('TAB PRESSED')
        if (this.currentSelected !== 'none') {
          console.log('Selected field')
          this.field.value = this.searchResults[this.currentSelected].name
        }
        if (document.getElementById(`search-results-${this.field.name}`)) {
          document.getElementById(`search-results-${this.field.name}`).remove()
        }
      }
      // ARROW DOWN
      if (e.keyCode === 40) {
        console.log('ARROW DOWN PRESSED')
        if (this.currentSelected !== 'none') {
          this.searchResults[this.currentSelected].selected = false
          this.currentSelected++
          if (this.searchResults[this.currentSelected]) {
            this.searchResults[this.currentSelected].selected = true
          } else {
            this.currentSelected--
            this.searchResults[this.currentSelected].selected = true
          }
          this.render()
        }
      }
      // ARROW UP
      if (e.keyCode === 38) {
        console.log('ARROW UP PRESSED')
        if (this.currentSelected !== 'none') {
          this.searchResults[this.currentSelected].selected = false
          this.currentSelected--
          if (this.searchResults[this.currentSelected]) {
            this.searchResults[this.currentSelected].selected = true
          } else {
            this.currentSelected++
            this.searchResults[this.currentSelected].selected = true
          }
          this.render()
        }
      }
      // Enter add the curent selected to the field
      if (e.keyCode === 13) {
        console.log('ENTER PRESSED')
        if (this.currentSelected !== 'none') {
          console.log('Selected field')
          this.field.value = this.searchResults[this.currentSelected].name
        }
        if (document.getElementById(`search-results-${this.field.name}`)) {
          document.getElementById(`search-results-${this.field.name}`).remove()
        }
        e.preventDefault()
        e.stopPropagation()
      }
    })
  }

  /**
   * Sets the datas from the api in the local datas
   * @param {*} datas
   */
  setDatas (datas) {
    console.log('NEW DATAS SETTED')
    if (datas.length > 0) {
      datas[0].selected = true
      this.currentSelected = 0
      this.searchResults = datas
    } else {
      this.currentSelected = 'none'
      this.searchResults = [{
        name: 'Aucun résultats'
      }]
    }
  }

  /**
   * Render the current state of suggestions in the dom
   */
  render () {
    console.log('RENDERING RESULTS')
    if (this.searchResults !== null) {
      // Reset the content of the result box
      if (document.getElementById(`search-results-${this.field.name}`)) {
        document.getElementById(`search-results-${this.field.name}`).remove()
      }

      // Create the box for the drobtown content
      let content = document.createElement('div')
      content.className = 'dropdown-content'

      // Append search results in the box
      for (let result of this.searchResults) {
        let resultElement = document.createElement('div')
        resultElement.className = 'dropdown-item'
        if (result.selected === true) {
          resultElement.className += ' is-hovered'
        }
        resultElement.innerHTML = result.name
        content.appendChild(resultElement)
      }

      let results = document.createElement('div')
      results.className = 'dropdown-menu'
      results.id = `search-results-${this.field.name}`
      results.appendChild(content)

      this.resultsBox.appendChild(results)

      for (let searchResult of content.children) {
        searchResult.addEventListener('click', (e) => {
          this.field.value = e.target.innerText
          document.getElementById(`search-results-${this.field.name}`).remove()
        })
      }
    } else {
      // Reset the content of the result box
      if (document.getElementById(`search-results-${this.field.name}`)) {
        document.getElementById(`search-results-${this.field.name}`).remove()
      }
    }
  }

  /**
   * Make the call to the server to gets the results
   * @param {string} needle The needle to pass in the query
   */
  search (needle) {
    return new Promise((resolve, reject) => {
      console.log('API CALL')
      fetch(this.searchApiUrl, {
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
        .then(datas => {
          this.setDatas(datas)
          resolve()
        })
    })
  }
}
