<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        //order does matter
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // ERROR HANDLERS
        $errors = []; //holds errors that are returned and prevents user from signing up

        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email already registered!";
        }

        require_once 'config.session.inc.php';

        //This is the Post/Redirect/Get pattern redirecting after a POST prevents the browser from re-submitting the form if the user refreshes the error page. 
        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            //will return username and email back to form if errors exist for UX purposes
            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../index.php");
            die();
        }
        
        create_user($pdo, $pwd, $username, $email);

        header("Location: ../index.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
    die("Query Failed:". $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    die();
}