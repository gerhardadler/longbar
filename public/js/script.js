// Smooth scrolling
window.addEventListener("scroll", function() {
    document.body.style.backgroundPosition = "0px " + window.scrollY * 0.5 + "px"
})