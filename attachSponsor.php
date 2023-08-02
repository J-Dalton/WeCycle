<?php require("Check.php");

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';


$allsponsors = allSponsors($pdo);


$title = "Attach Sponsor";

if (isset($_REQUEST['submit_row_data'])) {

        $sp_name = filter_var($_REQUEST['sponsor_name']);
        $sponsorid = getSponsorIdByName($pdo, $sp_name);
        
        $sp_description = filter_var($_REQUEST['sp_description']);
        $sp_discount = filter_var($_REQUEST['product_discount']);
        $sp_img = filter_var($_REQUEST['img_ref']);
        $sp_hyperlink = filter_var($_REQUEST['sp_link']);

    

        createEventSponsor($pdo, $sponsorid, $_GET['event_id'], $sp_description, $sp_discount, $sp_img, $sp_hyperlink);

        header('Location: viewEvent.php?event_id='. $_GET['event_id']);
   

}

if (isset($_REQUEST['add_another_item'])) {

    $sp_name = filter_var($_REQUEST['sponsor_name']);
    $sponsorid = getSponsorIdByName($pdo, $sp_name);
    
    $sp_description = filter_var($_REQUEST['sp_description']);
    $sp_discount = filter_var($_REQUEST['product_discount']);
    $sp_img = filter_var($_REQUEST['img_ref']);
    $sp_hyperlink = filter_var($_REQUEST['sp_link']);



    createEventSponsor($pdo, $sponsorid, $_GET['event_id'], $sp_description, $sp_discount, $sp_img, $sp_hyperlink);


}



ob_start();
include 'template/attachSponsor.html.php';
$output = ob_get_clean();
include 'template/layout.html.php';