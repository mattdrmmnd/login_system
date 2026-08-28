<?php

declare(strict_types=1);


function signup_inputs() {

    //Checks if data is available AND if this error message is not in webpage
    if (isset($_SESSION['signup_data']["username"]) && !isset($_SESSION['errors_signup']["username_taken"])) {
        echo '<input type="text" name="username" placeholder="Username" value="' . $_SESSION['signup_data']["username"] . '">';

    //Errors exist or no data sent back then show regular input
    } else {
        echo '<input type="text" name="username" placeholder="Username">';
    }

    echo '<input type="password" name="pwd" placeholder="Password">';

    if (isset($_SESSION['signup_data']["email"]) && !isset($_SESSION['errors_signup']["email_used"]) && !isset($_SESSION['errors_signup']["invalid_email"])) {
        echo '<input type="text" name="email" placeholder="E-Mail" value="' . $_SESSION['signup_data']["email"] . '">';

    //Errors exist or no data sent back then show regular input
    } else {
        echo '<input type="text" name="email" placeholder="E-Mail">';
    }
}

function check_signup_errors() {
    
    if  (isset($_SESSION["errors_signup"])) {
        $errors = $_SESSION["errors_signup"];//var equal to an array with all the errors in it

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }

        unset($_SESSION["errors_signup"]);//once done running script, data no longer needed so it's removed
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo "<br>";
        echo '<p>Signup success!</p>';
    }
}