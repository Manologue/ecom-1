const refreshUserPhoto = (userPhoto) => {
  // def data
  const data = new URLSearchParams()
  const action = 'getUserPhoto'
  data.append('action', action)
  fetch(`../../resources/templates/back/ajax/users.php`, {
    method: 'POST',
    body: data,
  })
    .then((response) => response.text())
    .then((response) => {
      userPhoto.src = `../../resources/uploads/${response}`
    })
    .catch((error) => console.log(error))
}

export default refreshUserPhoto
