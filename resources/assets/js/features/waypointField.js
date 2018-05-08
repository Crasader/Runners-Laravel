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
    })
  }
}
