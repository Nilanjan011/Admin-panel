<?php
session_start();
if (isset($_REQUEST["out"])) {
    session_destroy();//session destroy
    unset($_SESSION['email']); //destroy session array
    header("location: login.php"); // //redirect to login.php file
}
