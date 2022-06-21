<?php
include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$stmt = $conn->prepare(
    "SELECT name, description
    FROM categories
    WHERE id=?
    LIMIT 1;"
);
$stmt->bind_param('i', $category_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    $category_name = $row["name"];
    $category_description = $row["description"];
}

$stmt = $conn->prepare(
    "SELECT
        guides.name AS guide_name,
        guides.description AS guide_description
    FROM guides
    INNER JOIN guide_category
    ON guide_category.guide_id = guides.id
    INNER JOIN categories
    ON guide_category.category_id = categories.id
    WHERE categories.id = ?;"
);
$stmt->bind_param('i', $category_id);
$stmt->execute();
$result = $stmt->get_result();

$guides = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $guide_link = '/guides/' . preg_replace('/[^a-z0-9]+/', '-', strtolower($row["guide_name"]));
        $guides .=
'<div class="guide">
    <img class="guide-img" src="/images/laptop-with-tetris.jpg">
    <div class="guide-main">
        <h2>' . $row["guide_name"] . '</h2>
        <p>
            ' . $row["guide_description"] . '
        </p>
        <a href="' . $guide_link . '" class="guide-button">Read more</a>
    </div>
</div>';
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