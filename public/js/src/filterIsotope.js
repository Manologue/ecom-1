const elem = document.querySelector('.product-wrapper')

const iso = new Isotope(elem, {
  itemSelector: '.product-card',
  layoutMode: 'fitRows',
})
/* choose category */
window.addEventListener('DOMContentLoaded', function () {
  const urlID = window.location.search
  if (urlID) {
    console.log(urlID)
    const category = urlID.split('=')[1]
    console.log(category)
    iso.arrange({ filter: `.${category}` })
    const buttons = document.querySelectorAll('.product-filter')
    console.log(buttons)
    buttons.forEach((button) => {
      button.classList.remove('is-checked')

      if (button.getAttribute('data-filter') === `.${category}`) {
        button.classList.add('is-checked')
      }
    })
  }
  const filtersElem = document.querySelector('#filter')

  if (filtersElem) {
    filtersElem.addEventListener('click', function (event) {
      if (!matchesSelector(event.target, 'button')) {
        return
      }
      // get value of data-filter attribute on clicked button
      let filterValue = event.target.getAttribute('data-filter')
      iso.arrange({ filter: filterValue })
    })

    // change is-checked class on buttons when clicked
    const buttonGroups = document.querySelectorAll('.filter-group')
    for (let i = 0, len = buttonGroups.length; i < len; i++) {
      let buttonGroup = buttonGroups[i]
      radioButtonGroup(buttonGroup)
    }

    function radioButtonGroup(buttonGroup) {
      buttonGroup.addEventListener('click', function (event) {
        if (!matchesSelector(event.target, 'button')) {
          return
        }

        buttonGroup.querySelector('.is-checked').classList.remove('is-checked')
        event.target.classList.add('is-checked')
      })
    }
  }
})
