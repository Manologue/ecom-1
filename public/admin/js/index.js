import setMainSection from './src/setMainSection.js'
import { sideBar } from './src/sidebar.js'
import { setUrl } from './src/utils.js'

import './src/toggleTheme.js'

let url = ''

const init = async () => {
  url = window.location.href

  // set url history
  setUrl(url)
  // initial display of the main section
  setMainSection(url)
  // sidebar operations
  sideBar()

  // when url changes on popstate
  window.addEventListener('popstate', (e) => {
    e.preventDefault()
    setMainSection(window.history.state.additionalInformation)
  })
}

window.addEventListener('load', init)
