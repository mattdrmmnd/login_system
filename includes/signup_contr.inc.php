<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email) {
    if (empty($username) || empty($pwd) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo, string $username) 
{
    if (get_username($pdo, $username)) {
        return true; //error if username is taken
    } else {
        return false; //not an error if username not taken
    }
}

function is_email_registered(object $pdo, string $email) 
{
    if (get_email($pdo, $email) ) {
        return true; 
    } else {
        return false;
    }
}

function create_user(object $pdo, string $pwd, string $username, string $email) 
{
    set_user($pdo, $pwd, $username, $email);
}
