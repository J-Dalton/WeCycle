<?php require("Check.php");

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
$title = "View Group";

$group = getGroupByGroupId($pdo, $_GET['group_id']);
$allmembers = getAllGroupMembers($pdo, $_GET['group_id']);
$registeredcheck = checkIfUserRegistered($pdo, $_GET['group_id'], $_SESSION['id']);
$groupownercheck = checkIfGroupOwner($pdo, $_SESSION['id'], "YES", $_GET['group_id']);
$grouppersonnames = getGroupPersonNames($pdo, $_GET['group_id']);

$groupevents = getGroupEvents($pdo, $_GET['group_id']);
$totalmembers = countGroupMembers($pdo, $_GET['group_id']);



if (isset($_POST["register"])) {   
    addUserToGroup($pdo, $_SESSION['id'], $_GET['group_id'], "No");
    header("refresh:0");

}


if (isset($_POST["unregister"])) {
    deleteUserFromGroup($pdo, $_SESSION['id'], $_GET['group_id']);
    header("refresh:0");
}

if (isset($_POST["adminUnregister"])) {
    deleteUserFromGroup($pdo, $_POST['adminUnregister'], $_GET['group_id']);
    header("refresh:0");
  
}

if (isset($_REQUEST['delete-group-button'])) {
    deleteGroup($pdo, $_POST['delete-group-button']);
    header("Location: profile.php?page=2");
}

if (isset($_POST['editgroup'])){
    header("refresh:0");
    header('location:updateGroup.php?group_id=' . $_GET['group_id']);
    
}

if (isset($_REQUEST['back_button'])) {


    header("Location: Groups.php");
}

ob_start();
include 'template/viewGroup.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';

