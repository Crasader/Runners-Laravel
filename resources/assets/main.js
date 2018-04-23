/**
 * Main js file for all pages
 */

console.log('TUTU')

// Change the filename on file uploads
// User profile picture form
document.getElementById('user-picture-field').addEventListener('change', function () {
  if (this.files.length > 0) {
    document.getElementById('user-picture-name').innerHTML = this.files[0].name
  }
})
