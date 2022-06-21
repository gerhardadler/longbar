<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("This script can only be run through POST");
}

include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$sanitized_description = htmlspecialchars($_POST['description']);

$stmt = $conn->prepare(
    "INSERT INTO guides (name, description, content, old_version)
    SELECT name, description, content, 1
    FROM guides
    WHERE id = ?;"
);
$stmt->bind_param("i", $_POST["guide_id"]);
$stmt->execute();

$stmt = $conn->prepare(
    "UPDATE guides
    SET description = ?, content = ?
    WHERE id = ?;"
);
$stmt->bind_param("i", $_POST["guide_id"]);
$stmt->execute();

echo '<h1>Guide is updated!</h1><br><a href = "/">Return home</a>'
?>