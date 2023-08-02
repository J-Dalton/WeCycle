<?php require("Check.php");

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
date_default_timezone_set("Europe/London");
$event = getEventByEventId($pdo, $_GET['event_id']);

$allmembersevent = getAllEventMembers($pdo, $_GET['event_id']);
$registeredcheckevent = checkIfUserRegisteredEvent($pdo, $_GET['event_id'], $_SESSION['id']);
$eventownercheck = checkIfEventOwner($pdo, $_SESSION['id'], "YES", $_GET['event_id']);
$eventpersonnames = getEventFirstNames($pdo, $_GET['event_id']);
$eventcomments = getEventCommentsById($pdo, $_GET['event_id']);
$eventownername = getEventOwnerName($pdo, $_GET['event_id']);
$registered = countRegistered($pdo, $_GET['event_id']);
$comment_count = countEventComments($pdo, $_GET['event_id']);


$event_sponsor_details = eventSponsorDetails($pdo, $_GET['event_id']);
$sponsor_names = eventSponsorNames($pdo, $_GET['event_id']);









$users_existing_events = getEventsByIdJoin($pdo, $_SESSION['id']);
$this_events_details = getEventByEventId($pdo, $_GET['event_id']);

$arrlength = count($users_existing_events);

//gets all this events details, including group id 
$hostcheck = getEventByEventId_JoinGroup($pdo, $_GET['event_id']); foreach ($hostcheck as $check) {
    $finalnum = $check['group_id'];
}

//use group id to get hosting groups icon
if (!empty($finalnum)) {
    $icon = getGroupicon($pdo, $finalnum);
}




$title = "View event";
$fail_count = 0;



foreach ($event as $e) {
    $capacity = $e['event_capacity'];

}


foreach ($users_existing_events as $exists): foreach ($this_events_details as $this_event):

        if ($exists['event_id'] != $this_event['event_id']) {
            if (
                (strtotime($exists['event_datetime']) - strtotime($this_event['event_datetime'])) < 7200 &&
                (strtotime($exists['event_datetime']) - strtotime($this_event['event_datetime'])) > -7200

            ) {

                $fail_count++;
            }
        }
    endforeach;
endforeach;



if (isset($_POST["remove-item-button"])) {

    deleteProductFromEvent($pdo, $_POST["remove-item-button"]);
    header("refresh:0");

}



if (isset($_POST["register"])) {

    addUserToEvent($pdo, $_SESSION['id'], $_GET['event_id'], "No");
    header("refresh:0");

}


if (isset($_POST["edit_event_button"])) {

    header('location:updateEvent.php?event_id=' . $_GET['event_id']);

}


if (isset($_POST["delete-event-button"])) {


    deleteEvent($pdo, $_POST['delete-event-button']);
    header("Location: Events.php?page=1");

}


if (isset($_POST["unregister"])) {
    deleteUserFromEvent($pdo, $_SESSION['id'], $_GET['event_id']);
    header("refresh:0");
}


if (isset($_POST['comment-button'])) {
    if (!empty($_REQUEST['comment_content'])) {
        insertCommentByUserId($pdo, $_SESSION['id'], $_GET['event_id'], $_REQUEST['comment_content']);
        header("refresh:0");
    }

}

if (isset($_REQUEST['back_button'])) {
    header("Location: Events.php");
}
if (isset($_POST["remove-user-button"])) {

    deleteUserFromEvent($pdo, $_POST['remove-user-button'], $_GET['event_id']);
    header("refresh:0");
}

ob_start();
include 'template/viewEvent.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';