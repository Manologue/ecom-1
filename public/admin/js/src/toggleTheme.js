const switchMode = document.getElementById('switch-mode')
let darkMode = localStorage.getItem('dark-mode')

if (darkMode === 'enabled') {
  document.body.classList.add('dark')
  switchMode.checked = true
} else {
  document.body.classList.remove('dark')
  switchMode.checked = false
}

switchMode.addEventListener('change', function () {
  if (this.checked) {
    document.body.classList.add('dark')
    localStorage.setItem('dark-mode', 'enabled')
  } else {
    document.body.classList.remove('dark')
    localStorage.setItem('dark-mode', 'disabled')
  }
})
