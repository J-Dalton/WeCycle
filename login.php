<?php session_start(); 

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$title = "Login";

if(isset($_REQUEST['login-button'])) {

    $username = filter_var($_REQUEST['user_name']);
    $password = strip_tags($_REQUEST['user_password']);        

    if(!empty($password) && !empty($username)){
        $hashpassword = md5($password);
        $userdata = getUserid($pdo, $username, $hashpassword);
        if (empty($userdata)){
            $errormessage[2][] = "User name and password combination is incorrect, please try again";
        } else {
            $_SESSION['id'] = $userdata['user_id'];
            $_SESSION['user_name'] = $userdata['user_name'];
            $_SESSION['Authorised'] = "Y";
            
            if ($userdata['user_type'] == "ADMIN")  {
                $_SESSION['Admin'] = "Y";
            } else {
                $_SESSION['Admin'] = "N";
            }
            header('location: index.php');
        }
    }
}

ob_start();
include 'template/login.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';

