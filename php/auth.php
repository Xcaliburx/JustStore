<?php

include("php/config.php");

session_start();

if(!isset($_SESSION["user"])) {
    header("Location: guest.php");
}

$role = $_SESSION["user"]["role"];

?>