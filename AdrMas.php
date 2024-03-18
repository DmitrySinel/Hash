<?php
session_start();
require_once "ascii.php";
$_SESSION['num']['adres'] = $_POST['adres'];
$_SESSION['num']['mask'] = $_POST['mask'];
addOldValue('adres', $_POST['adres']);
addOldValue('mask', $_POST['mask']);
header(header: "Location: translateIP.php");
die();