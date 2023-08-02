<?php 
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$title = 'WeCycle';





ob_start();
include 'template/home.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';