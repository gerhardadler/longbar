<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("This script can only be run through POST");
}

if (strlen($_POST["username-or-email"]) > 320) {
    exit("The username or email is too long");
}
if (strlen($_POST["password"]) > 64) {
    exit("The password is too long");
}

session_start();

include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

$sanitized_username_or_email = htmlspecialchars($_POST["username-or-email"]);
$sanitized_password = htmlspecialchars($_POST["password"]);

$stmt = $conn->prepare(
    "SELECT id, username, email, password, profile_picture_link FROM users
    WHERE username = ? OR email = ?;"
);
$stmt->bind_param("ss", $sanitized_username_or_email, $sanitized_username_or_email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (password_verify($sanitized_password, $row["password"])) {
    if (isset($_POST["remember-me"])) {
        $remember_token = bin2hex(random_bytes(64)); // 64 bytes = 128 hexadecimal characters
        $stmt = $conn->prepare(
            "UPDATE users
            SET remember_token = ?
            WHERE id = ?;"
        );
        $stmt->bind_param("si", $remember_token, $row["id"]);
        $stmt->execute();
        setcookie("token", $remember_token, time() + (86400 * 30), "/", "dev.longbar.org", true, true); // 86400 = 1 day
    }
    $_SESSION["user_id"] = $row["id"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["email"] = $row["email"];
    $_SESSION["profile_picture_link"] = $row["profile_picture_link"];
    echo "Login successful!";
} else {
    echo "Login failed.";
}
?>