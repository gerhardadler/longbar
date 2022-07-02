<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
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
$stmt->bind_param("ssi", $_POST["description"], $_POST["content"], $_POST["guide_id"]);
$stmt->execute();

$stmt = $conn->prepare(
    "SELECT *
    FROM guide_user
    WHERE guide_id = ? AND user_id = ?"
);
$stmt->bind_param("ii", $_POST["guide_id"], $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt = $conn->prepare(
        "INSERT INTO guide_user (guide_id, user_id, first_author)
        VALUES (?, ?, ?);"
    );
    $first_author = false;
    $stmt->bind_param("iii", $_POST["guide_id"], $_SESSION["user_id"], $first_author);
    $stmt->execute();
}

echo '<h1>Guide is updated!</h1><br><a href = "/">Return home</a>'
?>