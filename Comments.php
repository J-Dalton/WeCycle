<?php require("Check.php");

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$event = getEventByEventId($pdo, $_GET['event_id']);
$eventcomments = getEventCommentsById($pdo, $_GET['event_id']);



foreach ($event as $e){
    $title = "Comments for " . '"' . $e['event_name'];
}

if (isset($_POST['comment-button'])) {
    if (!empty($_REQUEST['comment_content'])) {
        insertCommentByUserId($pdo, $_SESSION['id'], $_GET['event_id'], $_REQUEST['comment_content']);
        header("refresh:0");
    }

}

if (isset($_REQUEST['back_button'])) {


    header("Location: viewEvent.php?event_id=" . $_GET['event_id']);
}

ob_start();
include 'template/Comments.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';