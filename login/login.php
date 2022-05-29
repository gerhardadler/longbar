<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("This script can only be run through POST");
}

include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$sanitized_username_or_email = htmlspecialchars($_POST["username-or-email"]);
$sanitized_password = htmlspecialchars($_POST["password"]);

$stmt = $conn->prepare(
"SELECT id, username, password FROM users
WHERE username = ? OR email = ?;");
$stmt->bind_param("ss", $sanitized_username_or_email, $sanitized_username_or_email);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);

if (password_verify($sanitized_password, $row["password"])) {
    echo "Login successful!";
    if (isset($_POST["remember-me"])) {
        $remember_token = bin2hex(random_bytes(64)); // 64 bytes = 128 hexadecimal characters
        $stmt = $conn->prepare(
        "UPDATE users
        SET remember_token = ?
        WHERE id = ?;");
        $stmt->bind_param("si", $remember_token, $row["id"]);
        $stmt->execute();
        $cookie_name = "token";
        $cookie_value = $remember_token;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
    $_SESSION["username"] = $row["username"];
} else {
    echo "Login failed.";
}
?>