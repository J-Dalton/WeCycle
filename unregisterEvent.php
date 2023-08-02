<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';


deleteUserFromEvent($pdo, $_SESSION['id'], $_GET['event_id']);

header('location: profile.php?page=3');


include 'template/layout.html.php';
