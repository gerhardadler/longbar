<?php
if (isset($_COOKIE["user"])) {
    header("Location: editor");
}
?>
<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <h1>You must be logged in to create a guide</h1>
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    </body>
</html>