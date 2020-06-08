window.onscroll = function () {
  scrollFunction();
};

//for white color
function scrollFunction() {
  x = document.getElementsByClassName("navbar")[0];
  if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
    x.classList.remove("bg-transparent");
    x.classList.add("bg-white");
    x.classList.add("floatingNav");
    x.style.backgroundColor = "white";
  } else {
    x.classList.remove("bg-white");
    x.classList.add("bg-transparent");
    x.classList.remove("floatingNav");
    x.style.backgroundColor = "transparent";
  }
}
