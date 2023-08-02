<?php require("Check.php");

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$title = "Update Event";
$currenteventdetails = getEventByEventId($pdo, $_GET['event_id']);
$owned_groups = getOwnedGroups($pdo, $_SESSION['id']);
$relatedgroup = getEventByEventId_JoinGroup($pdo, $_GET['event_id']);

if (isset($_REQUEST['reg-event-button'])) {

    if (empty($_REQUEST['event_type'])) {
        $eventtype = NULL;
    } else {
        $eventtype = $_REQUEST['event_type'];
    }


    if (empty($_REQUEST['event_name'])) {
        $eventname = NULL;
    } else {
        $eventname = $_REQUEST['event_name'];
    }


    if (empty($_REQUEST['event_datetime'])) {
        $eventdatetime = NULL;
    } else {
        $eventdatetime = $_REQUEST['event_datetime'];
    }


    if (empty($_REQUEST['event_details'])) {
        $eventdetails = NULL;
    } else {
        $eventdetails = $_REQUEST['event_details'];
    }


    if (empty($_REQUEST['event_location'])) {
        $eventlocation = NULL;
    } else {
        $eventlocation = $_REQUEST['event_location'];
    }

    if (empty($_REQUEST['event_capacity'])) {
        $eventcapacity = NULL;
    } else {
        $eventcapacity = $_REQUEST['event_capacity'];
    }


    if (empty($_REQUEST['event_grouphost'])) {
        $event_grouphost = NULL;
    } else {
        $event_grouphost = $_REQUEST['event_grouphost'];
    }

    if (empty($_REQUEST['event_sponsor'])) {
        $event_sponsor = 0;
    } else {
        $event_sponsor = $_REQUEST['event_sponsor'];
    }

  





    if (empty($errormessage)) {
        $eventnamefound = eventNameexists($pdo, $eventname);
        if (!empty($eventnamefound)) {
            $errormessage[7][] = "Event name is already in use!";
        }
        if (empty($eventnamefound)) {

            updateEvent($pdo, $eventname, $eventtype, $eventdetails, $eventlocation, $eventdatetime, $eventcapacity, $event_grouphost, $_GET['event_id']);
        }
        if (!empty($event_grouphost)) {
            insertGroupEvent($pdo, $event_grouphost, $_GET['event_id']);
        }

        if ($event_sponsor == 0) {
            header('location:viewEvent.php?event_id=' . $_GET['event_id']);
        } else {
            header('location:attachSponsor.php?event_id=' . $_GET['event_id']);
        }

    }
}

if (isset($_REQUEST['back-button'])) {

    header('location:viewEvent.php?event_id=' . $_GET['event_id']);
}






ob_start();
include 'template/updateEvent.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';