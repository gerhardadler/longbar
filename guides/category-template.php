<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="/css/style.css">
        <script type="text/javascript" src="/js/script.js"></script>
        <script src="https://kit.fontawesome.com/4891e5aca9.js" crossorigin="anonymous"></script> <!-- Makes it easy to use icons -->
        <link rel="stylesheet" href="https://use.typekit.net/vkg1ncc.css"> <!-- Museo Slab Serif -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>[title]</title>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/html-elements/nav.html' ?>
        <div class="content-darker">
            
            <h1 class="blue">[title]</h1>
            
            <p class="category-description">
                [description]
            </p>

            <h2 class="opposite-sub-title">Related guides</h2>

            <div class="guides-container">        
[guides]
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/html-elements/footer.html' ?>
    </body>
</html>