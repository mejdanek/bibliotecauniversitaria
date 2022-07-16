<?php
session_start(); // inizio la sessione
$matricola = $_SESSION["matricola"]; // prendo la variabile di sessione
if (empty($user)) { // se la variabile di sessione è vuota
	header("Location:login.html.php"); // reindirizzo l'utente alla pagina di login
	exit;
}
?>
<?php
include 'common/header.html';
?>

<body>
	<!--Nav Bar-->
	<nav>
		<ul id="menu">
			<li><a href="user-page.php">Home</a></li>
			<li><a class="active" href="user-search-events.html.php">Cerca i libri</a></li>
			<li style="float:right"><a href="user-profile.php">Pagina Utente</a></li>
		</ul>
	</nav>
	<header>
		<br>
		<!--LogoICT-->
		<a href="user-page.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
		<!--Titolo-->
		<h1>Cerca eventi</h1>
	</header><br><br><br>
	<!--Immagine destra-->
	<div id="right"><img src="images/lente.png" alt="cerca" title="Lente" width="200"></div><br><br><br>
	<!--Inizio form-->
	<div id="center">
		<form action="user-event-result.php" method="post" name="cercaeventi">
			<fieldset><br>
				<label for="nome"><b>Inserisci una parola chiave:</b></label><br>
				<input type="text" name="nome" placeholder="Cerca..."><br><br>
				<label for="tipo"><b>Seleziona il tipo di evento:</b></label><br>
				<select name="tipo" required>
					<option hidden disabled selected value> -- seleziona un'opzione -- </option>
					<option value="concerti">Concerti</option>
					<option value="cinema">Cinema</option>
					<option value="teatro">Teatro</option>
					<option value="musei">Musei</option>
				</select><br><br>
				<label for="citta"><b>Inserisci la città dell'evento:</b></label><br>
				<input type="text" name="citta" placeholder="Città"><br><br>
				<input type="submit" value="Cerca!">
			</fieldset><br>
		</form>
	</div><br><br><br><br><br>
	<?php
include 'common/footer.html';
?>