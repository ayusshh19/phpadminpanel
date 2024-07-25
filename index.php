<?php
include "config/dbconfig.php";
include "model/Register.php";
include "model/Login.php";
include "model/User.php";


$conn = Connectdatabase();

$registerobj = new Register($conn);
$loginobj = new Login($conn);
$userobj = new User($conn);




