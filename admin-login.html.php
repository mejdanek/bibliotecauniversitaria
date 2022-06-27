<?php
session_start(); // inizio la sessione
if (isset($_SESSION["adminuser"])) { // se la variabile di sessione è settata
	$adminuser = $_SESSION["adminuser"]; // prendo la variabile di sessione
	if (!empty($adminuser)) { // se la variabile di sessione non è vuota
		header("Location:../tec_web/admin-home.php"); // reindirizzo l'admin alla admin-home
		exit;
	}
}
?>
<!DOCTYPE html>
<html lang="it-IT">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Tempo libero: eventi culturali e sportivi per studenti">
	<meta name="keywords" content="Eventi, attività, cultura, sport, tempo libero, studenti.">
	<meta name="author" content="Alessia Aniceto">
	<title>Admin Area</title>
	<link rel="stylesheet" type="text/css" href="stylesheet/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

<body>
	<!--Barra di navigazione-->
	<nav>
		<ul id="menu">
			<li><a href="index.html">Home</a></li>
			<li><a href="login.html.php">Area Utenti</a></li>
			<li style="float:right"><a class="active" href="admin-login.html.php">Admin Area</a></li>
		</ul>
	</nav>
	<header>
		<br>
		<!--LogoICT-->
		<a href="index.html"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
		<!--Titolo-->
		<h1>Admin Area</h1><br><br><br>
	</header>
	<!--Immagine destra-->
	<div id="right"><img src="images/admin.png" alt="admin" title="Admin" width="190"></div><br><br><br>
	<!--Inizio form-->
	<div id="center">
		<form action="admin-login.php" method="post" name="login">
			<fieldset><br>
				<label for="user"><b>Username</b></label><br>
				<input type="text" id="adminuser" name="adminuser" placeholder="Username" required><br><br>
				<label for="pwd"><b>Password</b></label><br>
				<input type="password" id="adminpwd" name="adminpwd" placeholder="Password" required><br><br>
				<input type="submit" value="Entra">
			</fieldset><br>
		</form>
	</div>

	<footer>
		<p id="p04">&copy; Copyright 2021. Tutti i diritti riservati.<br><b>Powered by Alessia Aniceto</b></p>
	</footer>
</body>

</html>