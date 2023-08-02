<?php require("Check.php");


include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if (empty($_GET['page'])) {
    header("Location: profile.php?page=1");
}




$alluserdata = allUserdata($pdo, $_SESSION["id"]);
$events = getEventsByIdJoin($pdo, $_SESSION["id"]);
$eventdetails = allEvents($pdo);
$groups = getGroupsByIdJoin($pdo, $_SESSION["id"]);



$title = "Profile";
$processing = "";

if (empty($_POST['filter'])) {
    $_POST['filter'] = "group_name";
}

if (empty($_POST['eventfilter'])) {
    $_POST['eventfilter'] = "event_name";
}



if (isset($_REQUEST['apply_filter'])) {
    if (!empty($_POST['filter'])) {
        $groups = getGroupsByIdJoin_Filter($pdo, $_SESSION['id'], $_POST['filter']);
        if (($_POST['filter']) == "is_group_owner") {
            $groups = array_reverse($groups);
        }
    }
}


if (isset($_REQUEST['apply_event_filter'])) {
    if (!empty($_POST['eventfilter'])) {
        $events = getEventsByIdJoin_Filter($pdo, $_SESSION['id'], $_POST['eventfilter']);
        if (($_POST['eventfilter']) == "is_event_owner") {
            $events = array_reverse($events);
        }
    }
}


if (isset($_REQUEST['delete-event-button'])) {
    deleteEvent($pdo, $_POST['delete-event-button']);
    header("Location: profile.php?page=3");
}


if (isset($_REQUEST['delete-group-button'])) {
  
    deleteGroup($pdo, $_POST['delete-group-button']);
    header("Location: profile.php?page=2");
}

if (isset($_REQUEST['delete-account-button'])) {
    deleteUser($pdo, $_SESSION['id']);
    insertToDeletedAccountTable($pdo, $alluserdata['first_name'], $alluserdata['last_name'], $alluserdata['user_name'], $alluserdata['user_password'], $_SESSION['id']);
    include 'Logout.php';
}


if (isset($_REQUEST['update-button'])) {

    $processing = " Processing...";
    $firstname = filter_var($_REQUEST['first_name'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_REQUEST['last_name'], FILTER_SANITIZE_STRING);
    $username = filter_var($_REQUEST['user_name'], FILTER_SANITIZE_STRING);
    $password = strip_tags($_REQUEST['user_password']);
    if ($alluserdata['user_type'] == "ADMIN") {
        $usertype = filter_var($_REQUEST['user_type'], FILTER_SANITIZE_STRING);
    }


    $firstname = trim($firstname);
    $lastname = trim($lastname);
    $username = trim($username);
    $password = trim($password);



    if (preg_match("/^[a-zA-Z0-9-`' ]+$/", $firstname)) {
        updateUserF($pdo, $firstname, $_SESSION["id"]);
        $errormessage[0][] = "";

    } elseif (empty($firstname)) {

        $errormessage[0][] = Null;

    } else {
        $errormessage[0][] = "Valid First name required";
    }


    if (preg_match("/^[a-zA-Z0-9-`' ]+$/", $lastname)) {
        updateUserL($pdo, $lastname, $_SESSION["id"]);
        $errormessage[1][] = "";

    } elseif (empty($lastname)) {


        $errormessage[1][] = Null;

    } else {
        $errormessage[1][] = "Valid Last name required";
    }

    if (preg_match("/^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/", $username)) {

        $usernamefound = userNameexists($pdo, $username);
        if (!empty($usernamefound)) {
            $errormessage[2][] = "User name is already in use, please use a different address";

        } elseif (empty($usernamefound)) {
            updateUserU($pdo, $username, $_SESSION["id"]);
            $_SESSION['user_name'] = $username;
            $errormessage[2][] = "";
        }

        if ((!preg_match("/^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/", $username))) {
            $errormessage[2][] = "Valid User name required";

        }

    }


    if (preg_match("/^[a-zA-Z0-9-!$%^&*()_+|~=`{}\[\]:\";\'<>?,.\/ ]+$/", $password)) {
        $password = md5($password);
        updateUserP($pdo, $password, $_SESSION["id"]);

        $errormessage[4][] = "";

    } elseif (empty($password)) {

        $errormessage[4][] = Null;

    } else {
        $errormessage[4][] = "Valid password required";
    }
    header("refresh:3");
}




ob_start();
include 'template/userprofile.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';