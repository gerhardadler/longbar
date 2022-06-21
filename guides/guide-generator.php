<?php

include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$stmt = $conn->prepare(
    "SELECT name, publish_time, description, content
    FROM guides
    WHERE id=?
    LIMIT 1;"
);
$stmt->bind_param('i', $guide_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    $guide_name = $row["name"];
    $guide_publish_time = $row["publish_time"];
    $guide_description = $row["description"];
    $guide_content = $row["content"];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://use.typekit.net/vkg1ncc.css"> <!-- Museo Slab Serif -->

        <link rel="stylesheet" href="/css/sitewide.css">
        <link rel="stylesheet" href="/css/guide.css">
        
        <script defer type="text/javascript" src="/js/script.js"></script>
        <script defer src="https://kit.fontawesome.com/4891e5aca9.js" crossorigin="anonymous"></script> <!-- Makes it easy to use icons -->

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title><?php echo $guide_name ?></title>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/html-elements/nav.html' ?>
        <div class="content">
            <div class="guide-page-content">
                <h1 class="guide-page-title"><?php echo $guide_name ?></h1>

                <p class="guide-page-description">
                    <?php echo $guide_description ?>
                </p>

                <div class="guide-page-info">
                    By: Clint Eastwood<br>
                    Published: <time datetime="2022-4-6"><?php echo $guide_publish_time ?></time><br>
                    <a class="hover-link" href="" id="fb_share" target="_blank"><i class="fa-brands fa-facebook-square"></i> Share on Facebook</a>

                    <script>
                        window.onload = function() {
                            fb_share.href ='https://www.facebook.com/share.php?u=' + encodeURIComponent(location.href); 
                        }  
                    </script>
                </div>

                <div class="guide-page-main-text">
                    <?php echo htmlspecialchars_decode($guide_content) ?>
                </div>
            </div>
            
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/html-elements/footer.html' ?>
    </body>
</html>