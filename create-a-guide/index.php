<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

if (isset($_SESSION["user_id"])) {
    header("Location: /editor");
}

if (isset($_COOKIE["token"])) {
    $stmt = $conn->prepare(
        "SELECT id, username, email, profile_picture_link
        FROM users
        WHERE remember_token = ?;"
    );
    $stmt->bind_param("s", $_COOKIE["token"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["profile_picture_link"] = $row["profile_picture_link"];

        // Update cookie expiration
        setcookie("token", $_COOKIE["token"], time() + (86400 * 30), "/", "dev.longbar.org", true, true); // 86400 = 1 day
        header("Location: /editor");
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>

    </head>

    <body>
        <h1>You must be logged in to create a guide</h1>
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    </body>
</html>