var editField = document.getElementById("ql-editor")
var toolbar = document.getElementById("toolbar")

var Editor = new Quill("#ql-editor", {
    modules: {
        toolbar: "#toolbar-main"
    },
    theme: "snow"
})

let removeFormatContent = [document.getElementById("guide-page-title"), document.getElementById("guide-page-description")]

removeFormatContent.forEach((item) => {
    item.addEventListener("keydown", (e) => {
        if (e.key == "Enter") {
            e.preventDefault()
        }
    })

    // https://stackoverflow.com/a/12028136/12834165
    item.addEventListener("paste", (e) => {
        // cancel paste
        e.preventDefault()

        // get text representation of clipboard
        var text = (e.originalEvent || e).clipboardData.getData('text/plain')

        // insert text manually
        document.execCommand("insertHTML", false, text)
    })
})

document.addEventListener("keydown", (e) => {
    if (e.key == "Control") {
        const video = document.querySelectorAll('.ql-video')
        console.log(video)
        video.forEach((item, index, object) => {
            if (!item.parentNode.classList.contains('ql-editor')) {
                object.slice(index, 1)
            }
        })
        console.log(video)
        const width = video.offsetWidth
        video.style.height = width * 2
    }
})