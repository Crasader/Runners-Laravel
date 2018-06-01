/**
 * Add functionalities for the filtering module
 * Imported by the filter blade component
 *
 * @author Bastien Nicoud
 */

document.getElementById('filtering-form').addEventListener('keypress', (e) => {
  if (e.keycode === 13) {
    e.preventDefault()
    document.getElementById('filtering-form').submit()
  }
})
