<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';


deleteUserFromGroup($pdo, $_SESSION['id'], $_GET['group_id']);

header('location: profile.php?page=2');


include 'template/layout.html.php';
