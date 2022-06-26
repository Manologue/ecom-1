const mobile = document.querySelector(".menu-toggle");
const mobileLink = document.querySelector(".menu-list");
if (mobile && mobileLink) {
  mobile.addEventListener("click", function () {
    mobile.classList.toggle("is-active");
    mobileLink.classList.toggle("active");
  });

  // close menu list
  mobileLink.addEventListener("click", function () {
    mobile.classList.toggle("is-active");
    mobileLink.classList.toggle("active");
  });
}
