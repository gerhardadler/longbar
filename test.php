<?php
include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$sql =
"SELECT content FROM guides
where id = 54";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo $row["content"];

?>