<?php require("Check.php");



$title = 'Events';
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
$pages_num = 2;



if (empty($_GET['page'])) {
    header("Location: Events.php?page=1");
}


if (empty($_GET['pattern'])) {
    $pattern = "";
} else {
    $pattern = $_GET['pattern'];
}


if (empty($_GET['filter'])) {
    $_GET['filter'] = "event_name";
    $display_filter = "Event Name";
    $totalevents = countEventsFiltered($pdo);
    $pagetotal = ceil($totalevents / $pages_num);
    $start_index = ($currentpage - 1) * $pagetotal;
    $events = searchPageEvents($pdo, $start_index, $pagetotal);

}

if ($_GET['filter'] == "event_name") {
    $display_filter = "Event Location";
    $totalevents = countEventsFiltered_eventname($pdo, $pattern);
    $pagetotal = ceil($totalevents / $pages_num);
    $start_index = ($currentpage - 1) * $pagetotal;
    $events = searchPageEvents_eventname($pdo, $pattern, $start_index, $pagetotal);
}

if ($_GET['filter'] == "event_datetime") {
    $display_filter = "Event Date";
    $totalevents = countEventsFiltered_eventdate($pdo, $pattern);
    $pagetotal = ceil($totalevents / $pages_num);
    $start_index = ($currentpage - 1) * $pagetotal;
    $events = searchPageEvents_eventdate($pdo, $pattern, $start_index, $pagetotal);

}

if ($_GET['filter'] == "event_location") {
    $display_filter = "Event Location";
    $totalevents = countEventsFiltered_eventlocation($pdo, $pattern);
    $pagetotal = ceil($totalevents / $pages_num);
    $start_index = ($currentpage - 1) * $pagetotal;
    $events = searchPageEvents_eventlocation($pdo, $pattern, $start_index, $pagetotal);

}

if ($_GET['filter'] == "is_event_owner") {
    $display_filter = "Event Owned";
    $totalevents = countEventsFiltered_eventowned($pdo, $pattern, $_SESSION['id']);
    $totalevents= sizeof($totalevents);
    $pagetotal = ceil($totalevents / $pages_num);
    $start_index = ($currentpage - 1) * $pagetotal;
    $events = searchPageEvents_eventowned($pdo, $pattern, $start_index, $pagetotal, $_SESSION['id']);

}



if (isset($_REQUEST['search_events_btn'])) {


    $pattern = $_POST['search_events'];


    if ($_POST['eventfilter'] == "event_name") {
        header("Location: Events.php?page=1&filter=event_name&pattern=" . $pattern);
        
    }

    if ($_POST['eventfilter'] == "event_location") {
        header("Location: Events.php?page=1&filter=event_location&pattern=" . $pattern);
        
    }

    if ($_POST['eventfilter'] == "event_datetime") {
        header("Location: Events.php?page=1&filter=event_datetime&pattern=" . $pattern);
        
    }

    if ($_POST['eventfilter'] == "is_event_owner") {
        header("Location: Events.php?page=1&filter=is_event_owner&pattern=" . $pattern);
        
    }

}


if (isset($_REQUEST['reset_filter'])) {
    header("Location: Events.php?page=1");

}


if (isset($_REQUEST['add-event-button'])) {
    header('location:createEvent.php');

}

ob_start();
include 'template/events.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';