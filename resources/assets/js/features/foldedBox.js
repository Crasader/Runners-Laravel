/**
* Script fot the folded boxes, allows to fold/unfold box thad declared in the page
*
* @author Bastien Nicoud
*/
export class FoldedBox {
  /**
   * Constructor
   * Pass ti it the unfolded element
   * @param {*} boxElement
   */
  constructor (boxElement) {
    this.unfoldedBox = boxElement
    this.unFoldedTitle = document.getElementById(`unfolded-title-${boxElement.dataset.foldedBoxId}`)
    this.foldedTitle = document.getElementById(`folded-title-${boxElement.dataset.foldedBoxId}`)
  }

  observe () {
    // Register event on the title
    this.foldedTitle.addEventListener('click', e => {
      e.preventDefault()
      e.stopPropagation()
      this.fold()
    })
    this.unFoldedTitle.addEventListener('click', e => {
      e.preventDefault()
      e.stopPropagation()
      this.fold()
    })
  }

  fold () {
    // Fold or unfold the box
    // With is-hidden attributes
    if (this.foldedTitle.classList.contains('is-hidden')) {
      this.foldedTitle.classList.remove('is-hidden')
      this.unFoldedTitle.classList.add('is-hidden')
      this.unfoldedBox.classList.add('is-hidden')
    } else if (this.unFoldedTitle.classList.contains('is-hidden')) {
      this.foldedTitle.classList.add('is-hidden')
      this.unFoldedTitle.classList.remove('is-hidden')
      this.unfoldedBox.classList.remove('is-hidden')
    }
  }
}
