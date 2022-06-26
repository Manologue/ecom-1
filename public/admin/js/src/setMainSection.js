import { allSideMenu } from './sidebar.js'
import pageOperation from './pageOperation.js'
import fetchPages from './fetchPages.js'

const container = document.querySelector('#main-container')

function checkSidebarLinks(url, link) {
  if (url === 'admin.php') {
    // set the active sidebar link
    const activeLink = allSideMenu.find((item) => {
      return item.getAttribute('href') === url
    })
    activeLink.parentElement.classList.add('active')

    // remove active on the rest of sidebar links
    allSideMenu.forEach((item) => {
      if (item !== activeLink) {
        item.parentElement.classList.remove('active')
      }
    })
    return
  }

  // check if there is any link page on the sidebar for other pages
  const sidebarLink = allSideMenu.find((item) => {
    return item.getAttribute('href') === `admin.php?${url}`
  })
  // if not
  if (!sidebarLink) {
    const activeLink = allSideMenu.find((item) => {
      return item.getAttribute('href') === `admin.php?${link}`
    })
    activeLink.parentElement.classList.add('active')
  } else {
    // if there is link page on the sidebar
    sidebarLink.parentElement.classList.add('active')
    // remove active on the rest of sidebar links
    allSideMenu.forEach((item) => {
      if (item !== sidebarLink) {
        item.parentElement.classList.remove('active')
      }
    })
  }
}

/**********************************************  GLOBAL FUNCTION    ********************************************/
const setMainSection = async (url) => {
  let link = ''
  if (url.includes('?')) {
    url = url.split('?').pop()
    // in case we want to fetch and display pages with _ in the url
    if (url.includes('_')) {
      let link = url.split('_').pop()
      // check if it has id
      if (url.includes('id')) {
        link = link.split('&')[0]
        let id = url.split('id=')[1]
        url = url.split('&')[0]

        checkSidebarLinks(url, link)
        // fetch url page
        fetchPages(`../../resources/templates/back/pages/${url}.php?id=${id}`).then(
          (data) => {
            container.innerHTML = data

            pageOperation(container)
          }
        )

        return
      }
      checkSidebarLinks(url, link)
      // fetch url page
      fetchPages(`../../resources/templates/back/pages/${url}.php`).then((data) => {
        container.innerHTML = data

        pageOperation(container)
      })

      return
    }
    // set the active sidebar link
    link = url
    checkSidebarLinks(url, link)
    // fetch and display the page
    const page = await fetchPages(`../../resources/templates/back/pages/${url}.php`)
    container.innerHTML = page

    pageOperation(container)
  } else {
    url = 'admin.php'
    checkSidebarLinks(url, link)
    // fetch and display the page
    const page = await fetchPages(`../../resources/templates/back/pages/admin_index.php`)
    container.innerHTML = page

    pageOperation(container)
  }
}

export default setMainSection

/******************************************************* END  *****************************************************************/
