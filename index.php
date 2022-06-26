<?php

if (!isset($_SESSION)) {
      session_start();
    }
include("templates/header.html");
include("templates/navbar.html.php");
include("templates/start.html");
include("templates/login.html.php");
include("templates/footer.html");
?>
