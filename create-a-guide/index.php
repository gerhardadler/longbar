<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://use.typekit.net/vkg1ncc.css"> <!-- Museo Slab Serif -->

        <!-- Quill Theme included stylesheets -->
        <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css">

        <link rel="stylesheet" href="/css/snow-customisation.css">
        <link rel="stylesheet" href="/css/sitewide.css">
        <link rel="stylesheet" href="/css/guide.css">
        <link rel="stylesheet" href="/css/create-a-guide.css">

        <script defer type="text/javascript" src="/js/script.js"></script>
        <script defer src="https://kit.fontawesome.com/4891e5aca9.js" crossorigin="anonymous"></script> <!-- Makes it easy to use icons -->
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Create a Guide</title>
    </head>
    <body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html-elements/nav.html' ?>
        <div id="toolbar-main">
            <span class="ql-formats">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-strike"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-blockquote"></button>
            </span>
            <span class="ql-formats">
                <select class="ql-header">
                    <option value="2"></option>
                    <option value="3"></option>
                    <option value=""></option>
                </select>
            </span>
            <span class="ql-formats">
                <button class="ql-list" value="ordered"></button>
                <button class="ql-list" value="bullet"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-script" value="sub"></button>
                <button class="ql-script" value="super"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-link"></button>
                <button class="ql-image"></button>
                <button class="ql-video"></button>
            </span>
            <span class="ql-formats">
                <select class="ql-color">
                    <option value="#1c212d"></option>
                    <option value="#dd6f10"></option>
                    <option value="#1974c0"></option>
                </select>
            </span>
        </div>
        <div class="content">
            <div class="guide-page-content">
                <h1 class="guide-page-title" contenteditable="true">Join communities</h1>

                <p class="guide-page-description" contenteditable="true">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                    Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et
                    magnis dis parturient montes, nascetur ridiculus mus.
                    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
                </p>

                <div class="guide-page-info">
                    By: Clint Eastwood<br>
                    Published: <time datetime="2022-4-6">6 April 2022</time><br>
                    <a class="hover-link" href="#" onclick="alert('Youre working on the guide dumbass')" id="fb_share"><i class="fa-brands fa-facebook-square"></i> Share on Facebook</a>
                </div>

                <div class="guide-page-main-text">
                    <div id="ql-editor"><p>Write your main content here!</p></div>
                </div>
            </div>
        </div>
        <button onclick="console.log(editor.root.innerHTML.trim())">Knapppppp</button>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/html-elements/footer.html' ?>
        <!-- Main Quill library -->
        <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

        <script type="text/javascript" src="/js/create-a-guide.js"></script> <!-- Loaded after DOM is ready -->
    </body>
</html>