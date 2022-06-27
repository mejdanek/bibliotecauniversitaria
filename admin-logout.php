<?php
session_start(); // inizio la sessione 
$adminuser = $_SESSION["adminuser"]; // prendo le variabili di sessione
$adminpwd = $_SESSION["adminpwd"];
session_destroy(); // distruggo la sessione
include_once "admin-logout.html"; // inlcudo il file admin-logout
