<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("This script can only be run through POST");
}

if (strlen($_POST["username"]) > 32) {
    exit("The username is too long");
}
if (strlen($_POST["email"]) > 320) {
    exit("The email is too long");
}
if (strlen($_POST["password"]) > 64) {
    exit("The password is too long");
}

include $_SERVER["DOCUMENT_ROOT"] . '/php-resources/connect-to-longbar-mysql.php';

function is_password_strong_enough($password) {
    if (strlen($password) < 8) {
        return false;
    }
    if (!preg_match('@[A-Z]@', $password)) {
        return false;
    }
    if (!preg_match('@[a-z]@', $password)) {
        return false;
    }
    if (!preg_match('@[0-9]@', $password)) {
        return false;
    }
    return true;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit("Not a valid email.");
}

if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
    exit("Your username can't be an email.");
}

$sanitized_username = htmlspecialchars($_POST["username"]);
$sanitized_email = htmlspecialchars($_POST["email"]);
$sanitized_password = htmlspecialchars($_POST["password"]);

$stmt = $conn->prepare(
    "SELECT username FROM users
    WHERE username = ?
    LIMIT 1;"
);
$stmt->bind_param('s', $sanitized_username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    exit("Username is taken.");
}

$stmt = $conn->prepare(
    "SELECT email FROM users
    WHERE email = ?
    LIMIT 1"
);
$stmt->bind_param('s', $sanitized_email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    exit("Email is taken.");
}

if (!is_password_strong_enough($sanitized_password)) {
    exit("Password must be 8 charaters or more long, contain at least one lower case letter, one upper case letter, and one number.");
}

$hashed_password = password_hash($sanitized_password, PASSWORD_DEFAULT);

echo "$sanitized_username<br>$sanitized_email<br>$hashed_password";

$stmt = $conn->prepare(
    "INSERT INTO users (username, email, password)
    VALUES (?, ?, ?);"
);

$stmt->bind_param('sss', $sanitized_username, $sanitized_email, $hashed_password);

$stmt->execute();
?>