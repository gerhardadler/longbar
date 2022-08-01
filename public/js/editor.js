const guidePageTitle =  document.getElementsByClassName("guide-page-title")[0]
const guidePageDescription =  document.getElementsByClassName("guide-page-description")[0]

var editField = document.getElementById("ql-editor")
var toolbar = document.getElementById("toolbar")

var editor = new Quill("#ql-editor", {
    modules: {
        toolbar: "#toolbar-main"
    },
    theme: "snow"
})

const removeFormatContent = [guidePageTitle, guidePageDescription]

removeFormatContent.forEach((item) => {
    item.addEventListener("keydown", (e) => {
        if (e.key==="Enter") {
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

const postGuideForm = document.getElementById("post-guide-form")
function postGuide(to_publish = false) {
    postGuideForm.name.value = guidePageTitle.textContent
    postGuideForm.description.value = guidePageDescription.textContent
    postGuideForm.content.value = editor.root.innerHTML
    postGuideForm.to_publish.value = to_publish ? "1" : "0"
    postGuideForm.submit()
}

const updateGuideForm = document.getElementById("update-guide-form")
function updateGuide() {
    updateGuideForm.description.value = guidePageDescription.textContent
    updateGuideForm.content.value = editor.root.innerHTML
    updateGuideForm.submit()
}