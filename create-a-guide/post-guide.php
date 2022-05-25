<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("This script can only be run through POST");
}

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

$sanitized_title = $conn->real_escape_string($_POST['title']);
$sanitized_description = $conn->real_escape_string($_POST['description']);
$sanitized_content = $conn->real_escape_string($_POST['content']);

$sql = 
"INSERT INTO guides (name, description, content)
VALUES ('$sanitized_title', '$sanitized_description', '$sanitized_content');";
//$result = $conn->query($sql);
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

//$insert_id = $conn->insert_id;
$insert_id = 7;
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
?>