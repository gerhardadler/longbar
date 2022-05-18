<?php
$servername = "localhost";
$username = "root";
$password = "";

function runQueryCheckError($sql) {
  global $conn;
  if ($conn->query($sql) === TRUE) {
    echo "Query was successful<br>";
  } else {
    echo "Error creating database: " . $conn->error . "<br>";
  }
}

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

// Use database
runQueryCheckError("USE longbar");

$sql = "SELECT * FROM guides";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<ul>";
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "<li>id: " . $row["id"] . "</li>";
    echo "<li>name: " . $row["name"] . "</li>";
    echo "<li>publish_time: " . $row["publish_time"] . "</li>";
    echo "<li>edit_time: " . $row["edit_time"] . "</li>";
    echo "<li>description: " . $row["description"] . "</li>";
    echo "<li>content: " . $row["content"] . "</li>";
  }
  echo "</ul>";
} else {
  echo "0 results";
}

$conn->close();
?>