<?php

declare(strict_types=1);

//Output Function holds session id. This is also how you can show content based on a certain user
function output_usename()
{
    if (isset($_SESSION["user_id"])) {
        echo "You are logged in as " . $_SESSION["user_username"] . " !";    
    } else {
        echo "You are not logged in.";
    }
}
function check_login_errors()
{
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }

        unset($_SESSION["errors_login"]);
    }
    else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo '<br>';
        echo '<p>Login Success!</p>';
    }
}