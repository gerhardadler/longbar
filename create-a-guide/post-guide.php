<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("This script can only be run through POST");
}

include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$sanitized_title = htmlspecialchars($_POST['title']);
$sanitized_description = htmlspecialchars($_POST['description']);

$stmt = $conn->prepare(
    "INSERT INTO guides (name, description, content)
    VALUES (?, ?, ?);"
);
$stmt->bind_param("sss", $sanitized_title, $sanitized_description, $_POST['content']);
$stmt->execute();

// https://stackoverflow.com/a/42908256/12834165
$file_name = preg_replace('/[^a-z0-9]+/', '-', strtolower($sanitized_title));

mkdir($_SERVER["DOCUMENT_ROOT"] . '/guides/' . $file_name);

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
$iteration = 0;

$stmt = $conn->prepare(
    "INSERT INTO guide_category (guide_id, category_id)
    VALUES (?, ?);"
);
$stmt->bind_param("ii", $insert_id, $iteration);

foreach ($selected_categories as $category) {
    $iteration += 1;
    if ($category) {
        $stmt->execute();
    }
}
?>