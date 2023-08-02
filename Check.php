<?php
session_start();
if ($_SESSION["Authorised"] != "Y") {
    ($_SESSION["Authorised"] = "N");
    ($_SESSION["Admin"] = "N");
    header("Location: Notauthorised.php");

}
?>