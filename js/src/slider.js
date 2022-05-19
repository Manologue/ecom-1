const productContainers = [...document.querySelectorAll(".product-container")];

const nxtBtn = [...document.querySelectorAll(".nxt-btn")];
const preBtn = [...document.querySelectorAll(".pre-btn")];
const circleBtn = [...document.querySelectorAll(".circle-slide")];
const circleNext = [...document.querySelectorAll(".circle-next")];
const circlePrev = [...document.querySelectorAll(".circle-prev")];
if (productContainers) {
  productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener("click", () => {
      item.scrollLeft += 300;

      // active circle on scroll
      if (item.scrollLeft > containerWidth - 700) {
        circleBtn.forEach((btn) => {
          btn.classList.remove("active");
        });
        circleNext[i].classList.add("active");
      }
    });

    preBtn[i].addEventListener("click", () => {
      item.scrollLeft -= 300;
      console.log(item.scrollLeft);

      // active circle on scroll
      if (item.scrollLeft < 600) {
        circleBtn.forEach((btn) => {
          btn.classList.remove("active");
        });
        circlePrev[i].classList.add("active");
      }
    });

    //circles on click

    circleNext[i].addEventListener("click", () => {
      item.scrollLeft += containerWidth;
      circleBtn.forEach((btn) => {
        btn.classList.remove("active");
      });
      circleNext[i].classList.add("active");
    });

    circlePrev[i].addEventListener("click", () => {
      item.scrollLeft -= containerWidth;
      circleBtn.forEach((btn) => {
        btn.classList.remove("active");
      });
      circlePrev[i].classList.add("active");
    });
  });
}
