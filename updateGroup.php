<?php require("Check.php");

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
$title = "Update Group";


$currentgroupinfo = getGroupsByGroupId($pdo, $_GET['group_id']);


$imgarray = [
    "uploads/coffee-colour.png",
    "uploads/coffee-bw.png",
    "uploads/coffee-wb.png",
    "uploads/cycling-yellow.png",
    "uploads/cycling-rb.png",
    "uploads/cycling-bw.png",
    "uploads/cycling-wb.png"
];

if (isset($_REQUEST['reg-group-button'])) {


    

    if (empty($_REQUEST['group_name'])) {
        $groupname = NULL;
    } else {
        $groupname = $_REQUEST['group_name'];
    }


    if (empty($_REQUEST['group_region'])) {
        $groupregion = NULL;
    } else {
        $groupregion = $_REQUEST['group_region'];
    }


    if (empty($_REQUEST['group_details'])) {
        $groupdetails = NULL;
    } else {
        $groupdetails = $_REQUEST['group_details'];
    }


    if (empty($_REQUEST['group_icon'])) {
        $groupicon = NULL;
    } else {
        $groupicon = $_REQUEST['group_icon'];
    }

    $groupnamefound = groupNameexists($pdo, $groupname);

    if (!empty($groupnamefound)) {

        $errormessage[7][] = "Group name is already in use!";

    }

    if (empty($groupnamefound)) {
        updateGroup($pdo, $groupname, $groupregion, $groupdetails, $groupicon, $_GET['group_id']);
        header('location:viewGroup.php?group_id=' . $_GET['group_id']);
    }


}


if (isset($_REQUEST['back-button'])) {

    header('location:viewGroup.php?group_id=' . $_GET['group_id']);
}

ob_start();
include 'template/updateGroup.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';