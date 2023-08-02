<?php require("Check.php");

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
date_default_timezone_set("Europe/London");

$owned_groups = getOwnedGroups($pdo, $_SESSION['id']);
$title = "Create an Event";



if (isset($_REQUEST['reg-event-button'])) {


    $eventname = filter_var($_REQUEST['event_name']);
    $eventdatetime = filter_var($_REQUEST['event_datetime']);
    $eventdetails = filter_var($_REQUEST['event_details']);
    $eventlocation = filter_var($_REQUEST['event_location']);
    $eventtype = filter_var($_REQUEST['event_type']);
    $eventcapacity = filter_var($_REQUEST['event_capacity']);
    $event_grouphost = filter_var($_REQUEST['event_grouphost']);
    $event_sponsor = filter_var($_REQUEST['event_sponsor']);

    $eventname = trim($eventname);
    $eventdatetime = trim($eventdatetime);
    $eventdetails = trim($eventdetails);
    $eventlocation = trim($eventlocation);
    $eventtype = trim($eventtype);
    $eventcapacity = trim($eventcapacity);
    $event_grouphost = trim($event_grouphost);


   


    if (empty($errormessage)) {

        $eventnamefound = eventNameexists($pdo, $eventname);


        if (!empty($eventnamefound)) {

            $errormessage[7][] = "Event name is already in use!";

        }

        if (empty($eventnamefound)) {

            if(empty($event_grouphost)){
                insertEvent($pdo, $eventname, $eventdatetime, $eventdetails, $eventlocation, $eventtype, $eventcapacity, null);
            } else{
                insertEvent($pdo, $eventname, $eventdatetime, $eventdetails, $eventlocation, $eventtype, $eventcapacity, $event_grouphost);
                
            }
            

            $eventid = getEventIdByName($pdo, $eventname);
            insertOwnerStatusEvent($pdo, $eventid, $_SESSION['id'], "YES");


                if(!empty($event_grouphost)){
                    insertGroupEvent($pdo, $event_grouphost, $eventid);
                }
                if($event_sponsor == 0){
                    header('location:viewEvent.php?event_id=' . $eventid);
                }
                else{
                    header('location:attachSponsor.php?event_id=' . $eventid);
                }
                
        

        }

    }
}




ob_start();
include 'template/createEvent.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';