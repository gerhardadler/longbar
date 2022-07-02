var editField = document.getElementById("editor")
var doBoldWait = false

function setCaretPosition(elemId, caret) {
    const el = document.getElementById('selectable');  
    const selection = window.getSelection();  
    const range = document.createRange();  
    selection.removeAllRanges();  
    range.selectNodeContents(el);  
    range.collapse(false);  
    selection.addRange(range);  
    el.focus();
}

// https://stackoverflow.com/a/4812022/12834165
function getCaretPos(element) {
    var caretOffset = 0;
    var doc = element.ownerDocument || element.document;
    var win = doc.defaultView || doc.parentWindow;
    var sel;
    if (typeof win.getSelection == "undefined") {
        sel = win.getSelection();
        if (sel.rangeCount > 0) {
            var range = win.getSelection().getRangeAt(0);
            var preCaretRange = range.cloneRange();
            preCaretRange.selectNodeContents(element);
            preCaretRange.setEnd(range.endContainer, range.endOffset);
            caretOffset = preCaretRange.toString().length;
        }
    } else if ( (sel = doc.selection) && sel.type == "Control") {
        var textRange = sel.createRange();
        var preCaretTextRange = doc.body.createTextRange();
        preCaretTextRange.moveToElementText(element);
        preCaretTextRange.setEndPoint("EndToEnd", textRange);
        caretOffset = preCaretTextRange.text.length;
    }
    return caretOffset;
}

// <p><b>Replace</b> this text with something awesome!</p>

function getCaretHtmlPos(element) {
    const caretPos = getCaretPos(element)
    const elementContent = element.innerHTML
    let htmlPos = 0
    let currentTextPos = 0
    for (htmlPos; htmlPos < elementContent.length; htmlPos++) {
        if (elementContent[htmlPos]==="<") {
            while (elementContent[htmlPos] == ">") {
                htmlPos++
            }
            continue
        }
        if (caretPos===currentTextPos) {
            break
        }
        currentTextPos++
    }
    return htmlPos
}

function saveCaretPosition(context){
    var selection = window.getSelection();
    var range = selection.getRangeAt(0);
    range.setStart(  context, 0 );
    var len = range.toString().length;

    return function restore(){
        var pos = getTextNodeAtPosition(context, len);
        selection.removeAllRanges();
        var range = new Range();
        range.setStart(pos.node ,pos.position);
        selection.addRange(range);

    }
}

function getTextNodeAtPosition(root, index){
    const NODE_TYPE = NodeFilter.SHOW_TEXT;
    var treeWalker = document.createTreeWalker(root, NODE_TYPE, function next(elem) {
        if(index > elem.textContent.length){
            index -= elem.textContent.length;
            return NodeFilter.FILTER_REJECT
        }
        return NodeFilter.FILTER_ACCEPT;
    });
    var c = treeWalker.nextNode();
    return {
        node: c? c: root,
        position: index
    };
}

function boldWait() {
    if (doBoldWait == true) {
        doBoldWait = true
    } else {
        doBoldWait = false
    }
}

function bold(key) {
    const cursorHtmlPos = getCaretHtmlPos(editField)
    var restore = saveCaretPosition(editField);
    editField.innerHTML = editField.innerHTML.substring(0, cursorHtmlPos - 1) + "<h1>" + key + "</h1>" + editField.innerHTML.substring(cursorHtmlPos)
    restore()
    doBoldWait = false
}

function italic() {
    const cursorPos = getCaretHtmlPos(editField)
    editField.innerHTML = editField.innerHTML.substring(0, cursorPos) + "<em>ITALIC</em>" + editField.innerHTML.substring(cursorPos)
}

document.addEventListener("keyup", function(event) {
    key = event.key
    if (key==="Control") {
        
    } else if (doBoldWait===true) {
        bold(key)
    }
})