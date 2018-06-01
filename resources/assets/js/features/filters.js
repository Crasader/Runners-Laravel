/**
 * Add functionalities for the filtering module
 * Imported by the filter blade component
 *
 * @author Bastien Nicoud
 */

document.onkeypress((e) => {
  e.preventDefault()
  if (e.keycode === 13) {
    document.getElementById('filtering-form').submit()
  }
})
