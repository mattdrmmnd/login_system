<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        //order does matter
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // ERROR HANDLERS
        $errors = []; //holds errors that are returned and prevents user from signing up

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username );

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        //SESSION
        require_once 'config.session.inc.php';

        //This is the Post/Redirect/Get pattern redirecting after a POST prevents the browser from re-submitting the form if the user refreshes the error page. 
        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            
            

            header("Location: ../index.php");
            die();
        }
        //Block that combines user id with session id
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        header("location: ../index.php?login=success");
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