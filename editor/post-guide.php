<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("This script can only be run through POST");
}

include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$sanitized_title = htmlspecialchars($_POST['title']);
$sanitized_description = htmlspecialchars($_POST['description']);

$stmt = $conn->prepare(
    "INSERT INTO guides (name, description, content, old_version)
    VALUES (?, ?, ?, 0);"
);
$stmt->bind_param("sss", $sanitized_title, $sanitized_description, $_POST['content']);
$stmt->execute();

$guide_id = $conn->insert_id;

$stmt = $conn->prepare(
    "INSERT INTO guide_user (guide_id, user_id, first_author)
    VALUES (?, ?, ?);"
);
$first_author = true;
$stmt->bind_param("iii", $guide_id, $_SESSION["user_id"], $first_author);
$stmt->execute();

$selected_categories = array(
    isset($_POST['equipment']),
    isset($_POST['history']),
    isset($_POST['new_player']),
    isset($_POST['software']),
    isset($_POST['strategy']),
    isset($_POST['streaming']),
    isset($_POST['tournaments'])
);

$iteration = 0;

$stmt = $conn->prepare(
    "INSERT INTO guide_category (guide_id, category_id)
    VALUES (?, ?);"
);
$stmt->bind_param("ii", $guide_id, $iteration);

foreach ($selected_categories as $category) {
    $iteration += 1;
    if ($category) {
        $stmt->execute();
    }
}

// https://stackoverflow.com/a/42908256/12834165
$guide_folder_name = preg_replace('/[^a-z0-9]+/', '-', strtolower($sanitized_title));

mkdir($_SERVER["DOCUMENT_ROOT"] . '/guides/' . $guide_folder_name);

$php_guide_file = fopen($_SERVER["DOCUMENT_ROOT"] . '/guides/' . $guide_folder_name . '/index.php', 'w');
fwrite($php_guide_file, 
    '<?php
    $guide_id = ' . $guide_id . ';
    include "../guide-generator.php"
    ?>'
);
fclose($php_guide_file);

echo '<h1>Guide is generated!</h1><br><a href = "/">Return home</a>'
?>