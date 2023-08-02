<?php
require("Check.php");

require("adminCheck.php");


$title = "Add Sponsor";
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';







if (isset($_REQUEST['reg-sponsor-button'])) {


    $sp_name = filter_var($_REQUEST['sponsor_name']);
    $sp_description = filter_var($_REQUEST['sponsor_description']);
    $sp_type = filter_var($_REQUEST['sponsor_type']);
    

    $sp_name = trim($sp_name);
    $sp_description = trim($sp_description);
    $sp_type = trim($sp_type);
 


   


    if (empty($errormessage)) {

        $spnamefound = sponsorNameexists($pdo, $sp_name);


        if (!empty($spnamefound)) {

            $errormessage[7][] = "Sponsor name is already in use!";

        }

        if (empty($spnamefound)) {
            createSponsor($pdo, $sp_name, $sp_description, $sp_type);
            header('location:admin.php?page=5');
        
        }

    }
}




ob_start();
include 'template/addSponsor.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';