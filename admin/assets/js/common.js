window.onscroll = function () {
    scrollFunction();
};

//for white color
function scrollFunction() {
    x = document.getElementsByClassName("navbar")[0];
    if (
        document.body.scrollTop > 60 ||
        document.documentElement.scrollTop > 60
    ) {
        x.classList.add("floatingNav");
        x.classList.remove("bg-transparent");
    } else {
        x.classList.remove("floatingNav");
        x.classList.add("bg-transparent");
    }
}

window.addEventListener("resize", displayWindowSize);

var head = document.querySelector(".heading");
var mq = window.matchMedia("(max-width: 570px)");

function displayWindowSize() {
    if (mq.matches) {
        // window width is at less than 570px
        head.classList.remove("display-3");
        head.classList.add("display-4");
    } else {
        // window width is greater than 570px
        head.classList.remove("display-4");
        head.classList.add("display-3");
    }
}

displayWindowSize();
