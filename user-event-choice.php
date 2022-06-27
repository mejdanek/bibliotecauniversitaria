<?php
session_start(); // inizio la sessione
$user = $_SESSION["user"]; // prendo la variabile di sessione
if (empty($user)) { // se la variabile di sessione è vuota
	header("Location:../tec_web/login.html.php"); // reindirizzo l'utente alla pagina di login
	exit;
} else { //altrimenti prendo la variabile con la scelta dell'utente
	$scelta = $_POST["scelta"];
}
?>
<!DOCTYPE html>
<html lang="it-IT">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Tempo libero: eventi culturali e sportivi per studenti">
	<meta name="keywords" content="Eventi, attività, cultura, sport, tempo libero, studenti.">
	<meta name="author" content="Alessia Aniceto">
	<title>Cerca eventi</title>
	<link rel="stylesheet" type="text/css" href="stylesheet/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

<!--Barra di navigazione-->
<nav>
	<ul id="menu">
		<li><a href="home.php">Home</a></li>
		<li><a class="active" href="user-search-events.html.php">Cerca eventi</a></li>
		<li style="float:right"><a href="user-profile.php">Pagina Utente</a></li>
	</ul>
</nav>
<header>
	<br>
	<!--LogoICT-->
	<a href="home.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
	<!--Immagine destra-->
	<div id="right"><img src="images/lente.png" alt="cerca" title="Lente" width="200"></div><br><br><br>
</header>

<body>
	<div id="center">
		<fieldset>
			<?php
			echo "<h1>Congratulazioni hai scelto l'evento:<br><br>";
			echo "<h2> " . $scelta . "!</h2>";
			?>
			<form action="user-search-events.html.php" method="post" name="back">
				<input type="submit" value="Torna indietro e cerca ancora!">
			</form>
			<br>
		</fieldset>
	</div>

	<br><br><br><br><br><br><br><br><br><br><br><br>
	<footer>
		<p id="p04">&copy; Copyright 2021. Tutti i diritti riservati.<br><b>Powered by Alessia Aniceto</b></p>
	</footer>
</body>

</html>