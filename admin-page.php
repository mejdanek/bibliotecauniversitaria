<?php
session_start(); // inizio la sessione
$adminuser = $_SESSION["adminuser"]; // prendo la variabile di sessione
if (empty($adminuser)) { // se la variabile non è stata settata (è vuota)
	header("Location:admin-login.html.php"); // reindirizzo l'utente alla pagina di login
	exit;
}
?>

<?php
include 'common/header.html';
?>

<script src="js/admin-page.js" type="text/javascript"></script>
<body>
	<!--Barra di navigazione-->
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
		<div class="container">
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="login.html.php">Area utenti</a>
					</li>
					<li class="nav-item"><a></a></li>
					<li class="nav-item active">
						<a class="nav-link" href="admin-login.html.php">Area admin</a>
					</li>
				</ul>

			</div>
		</div>
	</nav>
	<main role="main" class="container">
		<div class="jumbotron">
			<header>
				<!--Titolo-->
				<h1>Area di amministrazione sito</h1>
			</header><br><br><br><br>
			<br>
			

				<div id="utentebenvenuto">
      <table id="benvenuto">
      <td><p>Benvenuto <b>Amministratore</b><br><br></b></p></td>
      <td><form action="admin-logout.php" method="post" name="logout">
						<input type="submit" value="Logout">
					</form></td></table>
</div>
				<br>
			<!--Inizio form-->
			<div id="center">
				<fieldset>
					<h2>Cerca i libri</h2><br>  
					<div id="search-row">
						<form id="search-form" method="post" name="search-form">
							<input type="text" name="search" placeholder="Cerca...">
							<input type="image" src="images/search.png" value="Cerca" id="search-button">
						</form>
						<form id='read-all' name='read-all'>
							<input type='submit'  value='Mostra tutti i libri'>  <!--mostra tutti gli libri in precedenza-->
						</form>
					</div>
					<br><br>
					<div id="libri"></div><br><br>  <!--libri in precedenza-->
				</fieldset>
				<br>

				<fieldset>
					<h2>Aggiungi libro</h2><br>
					<form id="crealibri" method="post" name="aggiungilibri">
						<label for="titolo"><b>Titolo</b></label><br>
						<input type="text" name="titolo" placeholder="Inserire titolo" required><br><br>
						<label for="autore"><b>Autore</b></label><br>
						<input type="text" name="autore" placeholder="Inserire autore" required><br><br>
						<label for="editore"><b>Editore</b></label><br>
						<input type="text" name="editore" placeholder="Inserire editore" required><br><br>
						<label for="isbn"><b>Codice ISBN</b></label><br>
						<input type="text" name="isbn" placeholder="Inserire ISBN" required><br><br>
						<label for="giacenza"><b>Nr. copie</b></label><br>
						<input type="text" name="giacenza" placeholder="Inserire nr.copie" required><br><br>
						<input type="submit" id="create" value="Aggiungi"><br><br>
					</form>
				</fieldset>
				<br>

				<fieldset>
					<h2>Elimina utente</h2><br>
					<form action="admin-delete-user.php" method="post" name="eliminauser">
						<label for="user"><b>Inserire matricola da eliminare:</b></label><br>
						<input type="text" name="user" placeholder="Inserisci matricola" required><br><br>
						<input type="submit" value="Elimina Utente"><br><br>
					</form>
				</fieldset>
				<br>
			</div>
	</main>

	<?php
	include 'common/footer.html';
	?>