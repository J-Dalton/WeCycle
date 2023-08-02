<?php
require("Check.php");

require("adminCheck.php");



$title = "Admin Area";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if (empty($_GET['page'])) {
    header("Location: admin.php?page=1");
}

$allreports = getReports($pdo);

$alluserdata = allUsers($pdo);

$allevents = allEventsJoinedUser($pdo);

$allgroups = allGroups_Owners($pdo);

$allsponsors = allSponsors($pdo);

$title = "Profile";
$processing = "";

if (empty($_POST['filter'])) {
    $_POST['filter'] = "group_name";
}

if (empty($_POST['eventfilter'])) {
    $_POST['eventfilter'] = "event_name";
}

if (empty($_POST['userfilter'])) {
    $_POST['userfilter'] = "first_name";
}

if (empty($_POST['spfilter'])) {
    $_POST['spfilter'] = "sponsor_name";
}


if (isset($_REQUEST['apply_filter'])) {
    if (!empty($_POST['filter'])) {
        $allgroups = allGroups_Owners_Filtered($pdo, $_POST['filter']);
        
    }
}


if (isset($_REQUEST['apply_event_filter'])) {
    if (!empty($_POST['eventfilter'])) {
        $allevents = getEvents_Filtered($pdo, $_POST['eventfilter']);
     
        if (($_POST['eventfilter']) == "is_event_owner") {
            $allevents = array_reverse($allevents);
        }
    }
}
if (isset($_REQUEST['apply_user_filter'])) {
    if (!empty($_POST['userfilter'])) {
        $alluserdata = allUsers_Filtered($pdo, $_POST['userfilter']);
     
    }
}

if (isset($_REQUEST['apply_sp_filter'])) {
    if (!empty($_POST['spfilter'])) {
        $allsponsors = allSponsors_Filtered($pdo, $_POST['spfilter']);
     
    }
}


if (isset($_REQUEST['add_sponsor'])) {
    
    header('location:addSponsor.php');
}


if (isset($_REQUEST['delete-sponsor-button'])) {
    
    deleteSponsor($pdo, $_POST['delete-sponsor-button']);
    header("refresh:0");
}


if (isset($_REQUEST['delete-account-button'])) {

    deleteUser($pdo, $_POST['delete-account-button']);
    $userbyID = allUserdata($pdo, $_POST['delete-account-button']);
    insertToDeletedAccountTable($pdo, $userbyID['first_name'], $userbyID['last_name'], $userbyID['user_name'], $userbyID['user_password'], $_POST['delete-account-button']);

}

if (isset($_REQUEST['delete-comment-button'])) {
    deleteComment($pdo, $_POST['delete-comment-button']);
    header("refresh:0");
}

if (isset($_REQUEST['delete-event-button'])) {
    deleteEvent($pdo, $_POST['delete-event-button']);
    header("Location: admin.php?page=3");
}

ob_start();
include 'template/admin.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';