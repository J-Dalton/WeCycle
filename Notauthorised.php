<?php

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

ob_start();
include 'template/Notauthorised.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';