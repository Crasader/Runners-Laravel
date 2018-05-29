/**
* Script fot the runs creation page
*
* @author Bastien Nicoud
*/
export class WaypointField {
  /**
   * constructor
   * @param {Element} trigger The button that trigs a new field
   * @param {Element} field The field linked to this button
   */
  constructor (trigger = null) {
    this.trigger = trigger
    this.index = trigger.getAttribute('data-waypoint-index')
  }

  setTrigger (trigger) {
    this.trigger = trigger
  }

  /**
   * observe
   * Starts watching the add waypoint button...
   * Trigs new field creation on click
   * The button must have an index corresponding to his waypoint field...$
   * On update, the new field must be inserted directly after the current waypoint field
   * The index of the lat waypoint will be updated
   *
   * @param {Element} trigger The button that trigs a new waypoint field
   */
  observe () {
    console.log(`Observe button : ${this.trigger.id}`)
    this.trigger.addEventListener('click', (e) => {
      e.preventDefault()
      console.log(e)
      this.generateField()
    })
  }

  /**
   * Generate a new field next to the clicked button
   */
  generateField () {
    let node = document.createElement('div')
    node.classList = 'field is-horizontal'
    node.innerHTML = `
      <div class="field-label is-normal">
        <label class="label">Lieux ${this.index++}</label>
      </div>
      <div class="field-body">
        <div class="field is-grouped">
          <p id="search-field-waypoint[${this.index++}]" class="autocomplete control is-expanded has-icons-left">
            <input
              id="search-input-${this.index++}" 
              data-search-api-url="${document.getElementById(`search-input-${this.index}`).getAttribute('data-search-api-url')}"
              class="input"
              type="text"
              name="waypoint[${this.index++}]"
              placeholder="Lieux de passage ${this.index++}">
            <span class="icon is-small is-left">
              <i class="fas fa-map-signs"></i>
            </span>
          </p>
          <p class="control">
            <button id="add-waypoint-${this.index++}" data-waypoint-index="${this.index++}" class="button is-info">
              <span class="icon">
                <i class="fas fa-plus"></i>
              </span>
            </button>
          </p>
        </div>
      </div>
    `
    this.trigger.parentNode.insertBefore(node, this.trigger.nextSibling)
  }
}
