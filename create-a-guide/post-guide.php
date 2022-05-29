<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("This script can only be run through POST");
}

include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$sanitized_title = $conn->real_escape_string($_POST['title']);
$sanitized_description = $conn->real_escape_string($_POST['description']);
$sanitized_content = $conn->real_escape_string($_POST['content']);

$sanitized_title = htmlspecialchars($sanitized_title);
$sanitized_description = htmlspecialchars($sanitized_description);

$sql = 
"INSERT INTO guides (name, description, content)
VALUES ('$sanitized_title', '$sanitized_description', '$sanitized_content');";
$conn->query($sql);
echo $sql;

$selected_categories = array(
    isset($_POST['equipment']),
    isset($_POST['history']),
    isset($_POST['new_player']),
    isset($_POST['software']),
    isset($_POST['strategy']),
    isset($_POST['streaming']),
    isset($_POST['tournaments'])
);

$insert_id = $conn->insert_id;
//$insert_id = 7;
$sql = "";
$iteration = 0;
foreach ($selected_categories as $category) {
    $iteration += 1;
    if ($category) {
        $sql .=
        "INSERT INTO guide_category (guide_id, category_id)
        VALUES ($insert_id, $iteration);";
    }
}

echo $sql;
$conn->multi_query($sql);
echo $conn->error;
?>