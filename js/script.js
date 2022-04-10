// Smooth scrolling

window.addEventListener("scroll", function() {
    //this.alert("0px" + window.scrollY * 0.3 + "px")
    document.body.style.backgroundPosition = "0px " + window.scrollY * 0.5 + "px"
})