import './src/navBar.js'
import './src/swiper.js'
import './src/filterIsotope.js'
import './src/slider.js'
// import './src/cartBtns.js'

const form = document.querySelector('.contactForm form')
const alert = document.querySelector('.contactForm .alert')
console.log(form, alert)
form.addEventListener('submit', function (e) {
  e.preventDefault()
  const data = new URLSearchParams()
  for (const p of new FormData(form)) {
    data.append(p[0], p[1])
  }
  fetch('../resources/templates/front/ajax/messages.php', {
    method: 'POST',
    body: data,
  })
    .then((response) => response.text())
    .then((response) => {
      alert.innerHTML = response
      setTimeout(() => {
        alert.innerHTML = ''
      }, 3000)
      // reset the form
      form.reset()
    })
    .catch((error) => console.log(error))
})
