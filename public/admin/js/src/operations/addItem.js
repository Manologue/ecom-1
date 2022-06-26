const addItem = (form, container, alertDiv) => {
  // get window url
  let url = window.location.href
  let id = 0

  if (url.includes('_')) {
    url = url.split('_').pop()
    if (url.includes('id=')) {
      id = url.split('id=')[1]
      url = url.split('&')[0]
      // gallery
      url = `${url}.php?id=${id}`
    } else {
      // e.g add products add users
      url = `${url}.php`
    }
  } else {
    // e.g category
    url = `${url.split('?').pop()}.php`
  }

  form.addEventListener('submit', function (e) {
    // fetch the data from the form
    e.preventDefault()
    const data = new FormData(form)

    const action = form.getAttribute('action')

    // insert action in data
    data.append('action', action)

    fetch(`../../resources/templates/back/ajax/${url}`, {
      method: 'POST',
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        alertDiv.innerHTML = response

        // for pages where we have the add form and the element container at the same time
        if (url.includes('categories') || url.includes('id=')) {
          // reload page
          setTimeout(() => {
            window.location.reload()
          }, 1000)

          return
        }

        setTimeout(() => {
          alertDiv.innerHTML = ''
        }, 3000)
        // scroll on top to see alert
        container.scrollTo(0, 0)
        const img = form.querySelector('.img-upload')
        // in case we have an image
        if (img) {
          if (data.get('file').name !== '') {
            console.log('image')
            // clear the form
            // clear upload file
            img.src = ''
            const fileName = container.querySelector('.file-name')
            fileName.innerHTML = ''
            form.reset()
          }
        }
      })
      .catch((error) => console.log(error))
  })
}

export default addItem
