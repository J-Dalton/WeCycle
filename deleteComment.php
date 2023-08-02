<?php

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$eventfromcomment = getEventFromCommentId($pdo, $_GET['event_comments_id']);
deleteComment($pdo, $_GET['event_comments_id']);

header('location: Comments.php?event_id=' . $eventfromcomment);

include 'template/layout.html.php';