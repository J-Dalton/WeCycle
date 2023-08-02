<?php require("Check.php");

$title = "Report a comment";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';






$event_comment = getEventComment($pdo, $_GET['event_comments_id']);

foreach($event_comment as $comment){

   $comtext = $comment['comment_content'];
}


if (isset($_POST['submit-report'])){

    insertReport($pdo, $_SESSION['id'], $_GET['user_id'], $comtext, $_REQUEST['report_reason'], $_REQUEST['report_details'], $_GET['event_comments_id']);
    $eventid = getEventFromCommentId($pdo, $_GET['event_comments_id']);
    header("Location: viewEvent.php?event_id=" . $eventid);
}


ob_start();
include 'template/report.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';