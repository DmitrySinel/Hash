<?php
session_start();
require_once "ascii.php";
$_SESSION['num']['surname'] = $_POST['surname'];
$_SESSION['num']['p'] = $_POST['p'];
$_SESSION['num']['q'] = $_POST['q'];
addOldValue('surname', $_POST['surname']);
addOldValue('p', $_POST['p']);
addOldValue('q', $_POST['q']);
header(header: "Location: index.php");
die();