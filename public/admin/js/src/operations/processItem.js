const processItem = (item, container, alertDiv) => {
  const url = item.getAttribute('href')

  // confirm
  if (confirm('Are you sure to confirm the delivery?')) {
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
        }, 2000)
        clearTimeout(alertDiv)

        // check if item contains a class in order table for processing orders delivery
        if (item.classList.contains('order-process-btn')) {
          // add an font awesome icon inside the button
          item.innerHTML = `<i class="fa-solid fa-check-circle"></i>`
          let icon = item.querySelector('i')
          icon.classList.add('completed-color')

          const row = item.parentElement.parentElement
          const status = row.querySelector('.status')
          status.classList.remove('pending')
          status.classList.add('completed')
          status.innerHTML = 'complete'
        }
      })
      .catch((error) => console.log(error))
  }
}

export default processItem
