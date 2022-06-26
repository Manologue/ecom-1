const deleteItem = (item, container, alertDiv) => {
  const url = item.getAttribute('href')

  // confirm before deleting
  if (confirm('Are you sure you want to delete this item?')) {
    fetch(url, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    })
      .then((response) => response.text())
      .then((response) => {
        // go on top to see alert
        container.scrollTo(0, 0)
        // set time for alert
        alertDiv.innerHTML = response
        setTimeout(() => {
          alertDiv.innerHTML = ''
        }, 1000)
        clearTimeout(alertDiv)

        // for images gallery
        if (item.classList.contains('img-delete-btn')) {
          item.parentElement.parentElement.parentElement.remove()
        }
        // for tables
        if (item.classList.contains('table-delete-btn')) {
          // for users
          if (url.includes('users')) {
            // reload window
            alertDiv.innerHTML = ''
            window.location.reload()
            return
          }

          // delete item from the dom on a table
          const tableBody = container.querySelector('tbody')
          if (tableBody) {
            const itemToDelete = item.parentElement.parentElement
            // for sliders
            if (url.includes('sliders.php')) {
              if (tableBody.children.length === 1) {
                return
              }
            }
            itemToDelete.remove()
          }
          // show empty container if no items left
          const emptyContainer = container.querySelector('.empty-container')
          // get the table name from the url
          // get words between / and s
          let tableName = url.split('/').pop()
          tableName = `${tableName.split('s')[0]}`
          if (emptyContainer) {
            if (tableBody.children.length === 0) {
              setTimeout(() => {
                emptyContainer.style.display = 'grid'

                emptyContainer.innerHTML = `<h1>No ${tableName} found</h1>`
              }, 1000)
            }
          }
          // for table like categories
          const table = container.querySelector('table')
          if (table) {
            if (tableBody.children.length === 0) {
              setTimeout(() => {
                table.innerHTML = `<h1>No ${tableName}s found</h1>`
              }, 1000)
            }
          }
        }
      })
      .catch((error) => console.log(error))
  }
}

export default deleteItem
