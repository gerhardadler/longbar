var editField = document.getElementsByClassName("ql-editor")[0]
var toolbar = document.getElementById("toolbar")

var descriptionEditor = new Quill(".guide-page-description", {
    modules: {
        toolbar: "#toolbar-description"
    },
    theme: "snow"
})

var mainEditor = new Quill(".ql-editor", {
    modules: {
        toolbar: "#toolbar-main"
    },
    theme: "snow"
})

//editField.firstChild.setAttribute("tabindex", "0")

//mainEditor.disable()
//toolbar.innerHTML = toolbar.innerHTML

/*
editField.firstChild.addEventListener('focus', (event) => {
    toolbar.innerHTML = toolbarContent
    mainEditor.enable()
})

editField.firstChild.addEventListener('blur', (event) => {
    if (document.activeElement == toolbar) {
        toolbar.innerHTML = "Select an item to edit"
        mainEditor.disable()
    }
})*/