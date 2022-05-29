<?php
include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$sql = 
"SELECT
    name AS category_name,
    description AS category_description
FROM categories
WHERE id=$category_id
LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $category_name = $row["category_name"];
    $category_description = $row["category_description"];
}

$guide_template = '
                    <div class="guide">
                        <img class="guide-img" src="[guide_img]">
                        <div class="guide-main">
                            <h2>[guide_title]</h2>
                            <p>
                                [guide_description]
                            </p>
                            <a href="#" class="guide-button">Read more</a>
                        </div>
                    </div>
';

$guides = '';

$guide_to_be_replaced = array('[guide_title]',
                        '[guide_description]',
                        '[guide_img]'
);

$sql = 
"SELECT
    guides.name AS guide_name,
    guides.publish_time,
    guides.edit_time,
    guides.description AS guide_description,
    guides.content
FROM guides
INNER JOIN guide_category
ON guide_category.guide_id = guides.id
INNER JOIN categories
ON guide_category.category_id = categories.id
WHERE categories.id = $category_id;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $guide_replacement = array($row["guide_name"], $row["guide_description"], "/images/laptop-with-tetris.jpg");
        $guides .= str_replace($guide_to_be_replaced, $guide_replacement, $guide_template);
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://use.typekit.net/vkg1ncc.css"> <!-- Museo Slab Serif -->

        <link rel="stylesheet" href="/css/sitewide.css">
        <link rel="stylesheet" href="/css/guides-and-category.css">
        
        <script defer type="text/javascript" src="/js/script.js"></script>
        <script defer src="https://kit.fontawesome.com/4891e5aca9.js" crossorigin="anonymous"></script> <!-- Makes it easy to use icons -->

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title><?php echo $category_name ?></title>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/html-elements/nav.html' ?>
        <div class="content-darker">
            
            <h1 class="blue"><?php echo $category_name ?></h1>
            
            <p class="category-description">
            <?php echo $category_description ?>
            </p>

            <h2 class="opposite-sub-title">Related guides</h2>

            <div class="guides-container">        
                <?php echo $guides ?>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/html-elements/footer.html' ?>
    </body>
</html>