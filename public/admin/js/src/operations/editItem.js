const editItem = (form, container, alertDiv) => {
  // get window url
  let url = window.location.href
  const id = url.split('=')[1]

  if (url.includes('password')) {
    url = 'users'
  } else {
    url = url.split('edit_').pop()
    url = url.split('&')[0]
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault()

    const data = new FormData(form)

    const action = form.getAttribute('action')
    // insert action in data
    data.append('action', action)
    data.append('edit_id', id)

    fetch(`../../resources/templates/back/ajax/${url}.php`, {
      method: 'POST',
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        alertDiv.innerHTML = response
        // scroll on top to see alert
        container.scrollTo(0, 0)
        setTimeout(() => {
          alertDiv.innerHTML = ''
        }, 3000)
      })
      .catch((error) => console.log(error))
  })
}

export default editItem
