const elem = document.querySelector(".product-wrapper");

const iso = new Isotope(elem, {
  itemSelector: ".product-card",
  layoutMode: "fitRows",
});

const filtersElem = document.querySelector("#filter");

if (filtersElem) {
  filtersElem.addEventListener("click", function (event) {
    if (!matchesSelector(event.target, "button")) {
      return;
    }

    let filterValue = event.target.getAttribute("data-filter");
    iso.arrange({ filter: filterValue });
  });

  // change is-checked class on buttons
  const buttonGroups = document.querySelectorAll(".filter-group");
  for (let i = 0, len = buttonGroups.length; i < len; i++) {
    let buttonGroup = buttonGroups[i];
    radioButtonGroup(buttonGroup);
  }

  function radioButtonGroup(buttonGroup) {
    buttonGroup.addEventListener("click", function (event) {
      if (!matchesSelector(event.target, "button")) {
        return;
      }

      buttonGroup.querySelector(".is-checked").classList.remove("is-checked");
      event.target.classList.add("is-checked");
    });
  }
}
