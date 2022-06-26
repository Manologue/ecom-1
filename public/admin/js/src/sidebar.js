import setMainSection from './setMainSection.js'
import { setUrl } from './utils.js'

const allSideMenu = [...document.querySelectorAll('#sidebar .side-menu.top li a')]

const sideBar = () => {
  // ACTIVE SIDEBAR LINK
  // this part is just to remove the default behavior of the link and set our own properties
  allSideMenu.forEach((item) => {
    const li = item.parentElement

    item.addEventListener('click', function (e) {
      e.preventDefault()
      allSideMenu.forEach((i) => {
        i.parentElement.classList.remove('active')
      })
      li.classList.add('active')
      const url = item.getAttribute('href')
      // set url history and change the url on click
      setUrl(url)
      // set the main section
      setMainSection(url)
    })
  })  

  // TOGGLE SIDEBAR
  const menuBar = document.querySelector('#content nav .bx.bx-menu')
  const sidebar = document.getElementById('sidebar')

  menuBar.addEventListener('click', function () {
    sidebar.classList.toggle('hide')
  })

  const searchButton = document.querySelector('#content nav form .form-input button')
  const searchButtonIcon = document.querySelector(
    '#content nav form .form-input button .bx'
  )
  const searchForm = document.querySelector('#content nav form')

  searchButton.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
      e.preventDefault()
      searchForm.classList.toggle('show')
      if (searchForm.classList.contains('show')) {
        searchButtonIcon.classList.replace('bx-search', 'bx-x')
      } else {
        searchButtonIcon.classList.replace('bx-x', 'bx-search')
      }
    }
  })

  if (window.innerWidth < 768) {
    sidebar.classList.add('hide')
  } else if (window.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search')
    searchForm.classList.remove('show')
  }

  window.addEventListener('resize', function () {
    if (this.innerWidth > 576) {
      searchButtonIcon.classList.replace('bx-x', 'bx-search')
      searchForm.classList.remove('show')
    }
  })
}

// export allsideMenu and sidebar function
export { allSideMenu, sideBar }
