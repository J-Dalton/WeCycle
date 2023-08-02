<?php require("Check.php");

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
$title = 'Groups';
$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
$pages_num = 4;


if (empty($_GET['page'])) {
    header("Location: Groups.php?page=1");
}

if (empty($_GET['pattern'])) {
    $pattern = "";
} else {
    $pattern = $_GET['pattern'];
}

if (empty($_GET['filter'])) {
    $_GET['filter'] = "group_name";
    $totalgroups = countGroups($pdo);
    $pagetotal = ceil($totalgroups / 2);
    $start_index = ($currentpage - 1) * $pagetotal;
    $groups = getPageGroups($pdo, $start_index, $pagetotal);
}



if ($_GET['filter'] == "group_name") {
    $display_filter = "Group Name";
    $totalgroups = countGroupsFiltered_groupname($pdo, $pattern);
    $pagetotal = ceil($totalgroups / $pages_num);
    $start_index = ($currentpage - 1) * $pagetotal;
    $groups = searchPageGroups_groupname($pdo, $pattern, $start_index, $pagetotal);
}

if ($_GET['filter'] == "group_details") {
    $display_filter = "Group Details";
    $totalgroups = countGroupsFiltered_groupdetails($pdo, $pattern);
    $pagetotal = ceil($totalgroups / $pages_num);
    $start_index = ($currentpage - 1) * $pagetotal;
    $groups = searchPageGroups_groupdetails($pdo, $pattern, $start_index, $pagetotal);

}
if ($_GET['filter'] == "group_region") {
    $display_filter = "Group Region";
    $totalgroups = countGroupsFiltered_groupregion($pdo, $pattern);
    $pagetotal = ceil($totalgroups / $pages_num);
    $start_index = ($currentpage - 1) * $pagetotal;
    $groups = searchPageGroups_groupregion($pdo, $pattern, $start_index, $pagetotal);

}


if (isset($_REQUEST['search_groups_btn'])) {

    $pattern = $_POST['search_groups'];


    if ($_POST['groupfilter'] == "group_name") {
        header("Location: Groups.php?page=1&filter=group_name&pattern=" . $pattern);

    }

    if ($_POST['groupfilter'] == "group_details") {
        header("Location: Groups.php?page=1&filter=group_details&pattern=" . $pattern);

    }

    if ($_POST['groupfilter'] == "group_region") {
        header("Location: Groups.php?page=1&filter=group_region&pattern=" . $pattern);

    }
}


if (isset($_REQUEST['reset_filter'])) {
    header("Location: Groups.php?page=1");

}

if (isset($_REQUEST['add-group-button'])) {
    header('location:createGroup.php');

}

ob_start();
include 'template/groups.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';