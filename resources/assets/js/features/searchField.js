/**
* Script fot the search fields with autocomplete
* If you use the search field component (components/horizontal_search_input.blade.php)
* You need to include this script to work properly
*
* !! WARNING !! The search fields dosen't use api routes, because is not the same authentication system
*
* @author Bastien Nicoud
*/
export class SearchField {
  observe (searchField) {
    // Hook events on each search fields
    searchField.addEventListener('input', (e) => {
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
    })
  }

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
