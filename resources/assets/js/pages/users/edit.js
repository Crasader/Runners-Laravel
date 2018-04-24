/**
* Script fot the edit page
*
* @author Bastien Nicoud
*/

document.getElementById('user-picture-field').addEventListener('change', function () {
  if (this.files.length > 0) {
    document.getElementById('user-picture-name').innerHTML = this.files[0].name
  }
})

document.getElementById('user-licence-field').addEventListener('change', function () {
  if (this.files.length > 0) {
    document.getElementById('user-licence-name').innerHTML = this.files[0].name
  }
})
