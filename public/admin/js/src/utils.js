const setUrl = (url) => {
  const nextURL = url
  const nextTitle = 'My new page title'
  const nextState = { additionalInformation: nextURL }

  window.history.pushState(nextState, nextTitle, nextURL)
}

export { setUrl }
