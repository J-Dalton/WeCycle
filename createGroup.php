<?php require("Check.php");

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$imgarray = [
    "uploads/coffee-colour.png",
    "uploads/coffee-bw.png",
    "uploads/coffee-wb.png",
    "uploads/cycling-yellow.png",
    "uploads/cycling-rb.png",
    "uploads/cycling-bw.png",
    "uploads/cycling-wb.png"
];


$title = "Create a Group";


if (isset($_REQUEST['back-button'])) {
    
    header('location:Groups.php');

}


if (isset($_REQUEST['reg-group-button'])) {



    $groupname = filter_var($_REQUEST['group_name']);
    $groupdetails = filter_var($_REQUEST['group_details']);
    $groupicon = filter_var($_REQUEST['group_icon']);
    $groupregion = filter_var($_REQUEST['group_region']);

    $groupname = trim($groupname);
    $groupdetails = trim($groupdetails);
    $groupicon = trim($groupicon);
    $groupregion = trim($groupregion);

    $groupnamefound = groupNameexists($pdo, $groupname);


    if (!empty($groupnamefound)) {

        $errormessage[7][] = "Group name is already in use!";

    }

    if (empty($groupnamefound)) {

        insertGroup($pdo, $groupname, $groupdetails, $groupicon, $groupregion);

        $groupid = getGroupIdByName($pdo, $groupname);

        foreach ($groupid as $id):
            insertOwnerStatus($pdo, $id['group_id'], $_SESSION['id'], "YES");
            header('location:viewGroup.php?group_id=' . $id['group_id']);
        endforeach;
    }


}




ob_start();
include 'template/createGroup.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';