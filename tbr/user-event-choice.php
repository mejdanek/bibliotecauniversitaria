<?php
session_start(); // inizio la sessione
$matricola = $_SESSION["matricola"]; // prendo la variabile di sessione
if (empty($user)) { // se la variabile di sessione è vuota
	header("Location:login.html.php"); // reindirizzo l'utente alla pagina di login
	exit;
} else { //altrimenti prendo la variabile con la scelta dell'utente
	$scelta = $_POST["scelta"];
}
?>
<?php
include 'common/header.html';
?>

<!--Nav Bar-->
<nav>
	<ul id="menu">
		<li><a href="user-page.php">Home</a></li>
		<li><a class="active" href="user-search-events.html.php">Cerca eventi</a></li>
		<li style="float:right"><a href="user-profile.php">Pagina Utente</a></li>
	</ul>
</nav>
<header>
	<br>
	<!--LogoICT-->
	<a href="user-page.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
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
	<?php
include 'common/footer.html';
?>