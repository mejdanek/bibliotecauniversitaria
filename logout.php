<?php
session_start(); // inizio la sessione
$user = $_SESSION["user"]; // prendo la variabile di sessione
$pwd = $_SESSION["pwd"];
session_destroy(); // chiudo la sessione
include_once "logout.html.php"; // includo la pagina di logout
