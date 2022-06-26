const updateMessage = (item, countMssg) => {
  const url = item.getAttribute('href')
  // get the id of the item
  const id = url.split('=')[1]

  //fetch
  fetch(`../../resources/templates/back/ajax/messages.php?update_mssg=${id}`)
    .then((response) => response.text())
    .then((response) => {
      countMssg.innerHTML = response
      // if count messages is 0, hide the count
      if (response === '0') {
        countMssg.style.display = 'none'
      }
    })
    .catch((error) => console.log(error))
}

export default updateMessage
