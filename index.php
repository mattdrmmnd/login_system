<?php
declare(strict_types=1);

require_once 'includes/config.session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Login System</title>
</head>
<body>

    <h3>
        <?php
        output_usename();
        ?>
    </h3>

    <?php
    if (!isset($_SESSION["user_id"])) { ?>
        <h3>Login</h3>

        <form action="includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button>Login</button>
        </form>
        
    <?php } ?>

    <?php
    check_login_errors();
    ?>

    <?php
    if (!isset($_SESSION["user_id"])) { ?>
        <h3>Signup</h3>

        <form action="includes/signup.inc.php" method="post">
        <?php
        signup_inputs();
        ?>
        <button>Sign up</button>
    </form>
        
    <?php } ?>

    <?php
    check_signup_errors();
    ?>

    <?php
    if (isset($_SESSION["user_id"])) { ?>

        <form action="includes/logout.inc.php" method="post">
            <button>Logout</button>
        </form>
    <?php } ?>
    
    
    
</body>
</html>