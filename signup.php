<?php

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$title = "Signup";

if (isset($_REQUEST['signup-button'])) {

    $firstname = filter_var($_REQUEST['first_name']);
    $lastname = filter_var($_REQUEST['last_name']);
    $username = filter_var($_REQUEST['user_name']);
    $password = strip_tags($_REQUEST['user_password']);

    $firstname = trim($firstname);
    $lastname = trim($lastname);
    $username = trim($username);
    $password = trim($password);

    if (!preg_match("/^[a-z ,.'-]+$/i", $firstname)) {
        $errormessage[0][] = "First name cannot contain special characters";

    }



    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $errormessage[1][] = "Valid Email Address required";

    }


    if (empty($errormessage)) {


        $usernamefound = userNameexists($pdo, $username);


        if (!empty($usernamefound)) {

            $errormessage[2][] = "Email is already in use, please log in or use a different address";

        }

        if (empty($usernamefound)) {

            $hashpassword = md5($password);
            createUser($pdo, $firstname, $lastname, $username, $hashpassword, "NORMAL");
            header('location: login.php');

        }
    }


    for ($i = 0; $i < 3; $i++) {
        if (isset($errormessage[$i])) {
            foreach ($errormessage[$i] as $error) {
                $message =
                "<div class='signuperrorpos rounded border-0 shadow alert alert-danger my-0'>" .
                '<div class="rounded border-0">' .
                '<p class="loginform">' . "$error" . "</p>" .
                '</div>' .
                '</div>';

            }


        }
    }
}




ob_start();
include 'template/signup.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';