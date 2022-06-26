const productQuantityValue = document.querySelector('.product-quantity-value')
console.log(productQuantityValue)

if (productQuantityValue) {
  const reduceBtn = document.querySelector('.cart-reduce-btn')
  const addBtn = document.querySelector('.cart-add-btn')

  reduceBtn.addEventListener('click', function (e) {
    e.preventDefault()
    // href attribute of the button
    const href = this.getAttribute('href')
    console.log(href)
    fetch(href)
      .then((response) => response.text())
      .then((response) => {
        productQuantityValue.innerHTML = response
      })
      .catch((error) => console.log(error))
  })

  addBtn.addEventListener('click', function (e) {
    e.preventDefault()
  })
}
