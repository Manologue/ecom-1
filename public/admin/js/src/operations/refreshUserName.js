const refreshUserName = (userName) => {
  // def data
  const data = new URLSearchParams()
  const action = 'getUserName'
  data.append('action', action)
  fetch(`../../resources/templates/back/ajax/users.php`, {
    method: 'POST',
    body: data,
  })
    .then((response) => response.text())
    .then((response) => {
      userName.innerHTML = response
    })
    .catch((error) => console.log(error))
}

export default refreshUserName
