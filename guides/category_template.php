<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Use database
$conn->query("USE longbar");

$page = file_get_contents('../category-template.html');

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

$guide_output = '';

$to_be_replaced = array('[guide_title]',
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
        $replacement = array($row["guide_name"], $row["guide_description"], "/images/laptop-with-tetris.jpg");
        $guide_output .= str_replace($to_be_replaced, $replacement, $guide_template);
    }
}

$to_be_replaced = array('[title]',
                        '[description]',
                        '[guides]'
);

$sql = 
"SELECT
    name AS category_name,
    description AS category_description
FROM categories
WHERE id=$category_id
LIMIT 1;";
$result = $conn->query($sql);

echo $conn->error;

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $replacement = array($row["category_name"],
                         $row["category_description"],
                         $guide_output
    );
    $page = str_replace($to_be_replaced, $replacement, $page);
}

echo $page;
?>