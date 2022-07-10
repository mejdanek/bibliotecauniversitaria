<?php
session_start(); // inizio la sessione
$matricola = $_SESSION["matricola"]; // prendo la variabile di sessione
$pwd = $_SESSION["password"];
session_destroy(); // chiudo la sessione
include_once "logout.html.php"; // includo la pagina di logout
