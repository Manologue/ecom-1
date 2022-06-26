const countMessages = (count) => {
  fetch(`../../resources/templates/back/ajax/messages.php`)
    .then((response) => response.text())
    .then((response) => {
      count.innerHTML = response
      // if count messages is 0, hide the count
      if (response === '0') {
        count.style.display = 'none'
      }
    })
    .catch((error) => console.log(error))
}

export default countMessages
