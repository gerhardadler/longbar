<?php
if (isset($guide_id)) {
    include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

    $stmt = $conn->prepare(
        "SELECT name, description, content
        FROM guides
        WHERE id = ?
        LIMIT 1;"
    );
    $stmt->bind_param('i', $guide_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $title = $row["name"];
    $description = $row["description"];
    $content = $row["content"];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://use.typekit.net/vkg1ncc.css"> <!-- Museo Slab Serif -->

        <!-- Quill Theme included stylesheets -->
        <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css">

        <link rel="stylesheet" href="/css/snow-customisation.css">
        <link rel="stylesheet" href="/css/sitewide.css">
        <link rel="stylesheet" href="/css/guide.css">
        <link rel="stylesheet" href="/css/editor.css">

        <script defer type="text/javascript" src="/js/script.js"></script>
        <script defer src="https://kit.fontawesome.com/4891e5aca9.js" crossorigin="anonymous"></script> <!-- Makes it easy to use icons -->
        <!-- Main Quill library -->
        <script defer src="//cdn.quilljs.com/1.3.6/quill.js"></script>
        <script defer type="text/javascript" src="/js/editor.js"></script> <!-- Loaded after DOM is ready -->
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Editor</title>
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
                <h1 class="guide-page-title" contenteditable="true"><?php echo $title ?></h1>

                <p class="guide-page-description" contenteditable="true"><?php echo $description ?></p>

                <div class="guide-page-info">
                    By: Clint Eastwood<br>
                    Published: <time datetime="2022-4-6">6 April 2022</time><br>
                    <a class="hover-link" href="#" onclick="alert('Youre working on the guide dumbass')" id="fb_share"><i class="fa-brands fa-facebook-square"></i> Share on Facebook</a>
                </div>

                <div class="guide-page-main-text">
                    <div id="ql-editor"><?php echo $content ?></div>
                </div>
            </div>
            <?php if ($new_guide == true) { echo '
            <form id="post-guide-form" action="/editor/post-guide.php" method="post">
                <input type="hidden" name="title">
                <input type="hidden" name="description">
                <input type="hidden" name="content">
                <fieldset>
                    <legend>Choose the categories the guide falls in to</legend>
                    <label for="equipment">Equipment</label>
                    <input type="checkbox" value="checked" name="equipment"><br>
                    <label for="history">History</label>
                    <input type="checkbox" value="checked" name="history"><br>
                    <label for="new_player">New Player</label>
                    <input type="checkbox" value="checked" name="new_player"><br>
                    <label for="software">Software</label>
                    <input type="checkbox" value="checked" name="software"><br>
                    <label for="strategy">Strategy</label>
                    <input type="checkbox" value="checked" name="strategy"><br>
                    <label for="streaming">Streaming</label>
                    <input type="checkbox" value="checked" name="streaming"><br>
                    <label for="tournaments">Tournaments</label>
                    <input type="checkbox" value="checked" name="tournaments"><br>
                </fieldset>
            </form>
            '; } else { echo "
            <form id='update-guide-form' action='/editor/update-guide.php' method='post'>
                <input type='hidden' name='description'>
                <input type='hidden' name='content'>
                <input type='hidden' name='guide_id' value='$guide_id'>
            </form>";} ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/html-elements/footer.html' ?>
    </body>
</html>