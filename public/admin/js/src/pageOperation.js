/* this function is to control the operations of all the pages */

import setMainSection from './setMainSection.js'
import { setUrl } from './utils.js'

//operation fxns
import uploadImg from './operations/uploadImg.js'
import deleteItem from './operations/deleItem.js'
import addItem from './operations/addItem.js'
import emptyTable from './operations/emptyTable.js'
import editItem from './operations/editItem.js'
import processItem from './operations/processItem.js'
import updateMessage from './operations/updateMessage.js'
import countMessages from './operations/countMessages.js'
// import refreshUserName from './operations/refreshUserName.js'
// import refreshUserPhoto from './operations/refreshUserPhoto.js'

const pageOperation = async (container) => {
  // btn that redirects to another page
  const btnDiv = container.querySelectorAll('.btn-div > a')

  // upload img
  const img = container.querySelector('.img-upload')
  // alert
  const alertDiv = container.querySelector('.alert-div')
  // table
  const table = container.querySelector('table')
  // process btn
  const processBtn = container.querySelectorAll('.process-btn')

  //crud operations selectors
  const deleBtns = container.querySelectorAll('.delete-btn')
  const form = container.querySelector('.form')
  // for messages
  const countMssg = document.querySelector('.count-mssg')
  const mssgBtns = container.querySelectorAll('.view-mssg > a')
  // user
  // const userName = document.querySelector('.user-name')
  // const userPhoto = document.querySelector('.user-photo')

  /***** functions *****/
  if (img) {
    uploadImg(container, img)
  }

  if (btnDiv) {
    btnDiv.forEach((btn) => {
      btn.addEventListener('click', function (e) {
        e.preventDefault()
        const url = this.getAttribute('href')

        // set url history and change the url on click
        setUrl(url)
        // set the main section
        setMainSection(url)
      })
    })
  }
  if (deleBtns) {
    deleBtns.forEach((item) => {
      item.addEventListener('click', function (e) {
        e.preventDefault()

        deleteItem(item, container, alertDiv)
      })
    })
  }
  if (form) {
    const action = form.getAttribute('action')
    if (action === 'add' || action === 'add_gallery') {
      addItem(form, container, alertDiv)
    }
    if (action === 'edit' || action === 'edit_password') {
      editItem(form, container, alertDiv)
    }
  }

  // if table tbody is empty
  if (table) {
    emptyTable(container, table)
  }

  // process btn
  if (processBtn) {
    processBtn.forEach((item) => {
      item.addEventListener('click', function (e) {
        e.preventDefault()

        processItem(item, container, alertDiv)
      })
    })
  }

  // for messages
  if (mssgBtns) {
    mssgBtns.forEach((item) => {
      item.addEventListener('click', function (e) {
        e.preventDefault()
        updateMessage(item, countMssg, container)
      })
    })
  }

  // refresher
  setInterval(() => {
    countMessages(countMssg)
    // refreshUserName(userName)
    // refreshUserPhoto(userPhoto)
  }, 700)
}
export default pageOperation
