const uploadImg = (container, img) => {
  /* img upload */

  const wrapper = container.querySelector('.wrapper')
  const fileName = container.querySelector('.file-name')
  const defaultBtn = container.querySelector('#default-btn')
  const customBtn = container.querySelector('#custom-btn')
  const cancelBtn = container.querySelector('#cancel-btn i')

  let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/

  if (customBtn) {
    customBtn.addEventListener('click', () => {
      defaultBtnActive()
    })
  }

  function defaultBtnActive() {
    defaultBtn.click()
  }

  if (defaultBtn) {
    defaultBtn.addEventListener('change', function () {
      const file = this.files[0]
      if (file) {
        const reader = new FileReader()
        reader.onload = function () {
          const result = reader.result
          img.src = result
          wrapper.classList.add('active')
        }
        cancelBtn.addEventListener('click', function () {
          img.src = ''
          wrapper.classList.remove('active')
        })
        reader.readAsDataURL(file)
      }
      if (this.value) {
        let valueStore = this.value.match(regExp)
        fileName.textContent = valueStore
      }
    })
  }
}

export default uploadImg
