<?php
session_start();  // inizio la sessione
$user = $_SESSION["user"]; // prendo la variabile di sessione
if (empty($user)) { // se la variabile di sessione è vuota
	header("Location:login.html.php"); // reindirizzo l'utente alla pagina di login
	exit;
}
?>
<?php
include 'common/header.html';
?>

<body>
	<!--Nav bar-->
	<nav>
		<ul id="menu">
			<li><a href="home.php">Home</a></li>
			<li><a href="user-search-events.html.php">Cerca eventi</a></li>
			<li style="float:right"><a class="active" href="user-profile.php">Pagina Utente</a></li>
		</ul>
	</nav>
	<header>
		<br>
		<!--LogoICT-->
		<a href="home.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
		<!--Titolo-->
		<h1>Il tuo profilo</h1><br><br>
		<!--Immagine destra-->
		<div id="right"><img src="images/account.png" alt="elimina" title="Elimina" width="190"></div><br>
		<div id="center">
			<fieldset>
				<h2>Le tue informazioni</h2><br>
				<?php
				include_once 'db-connect-db-close.php'; // includo il file di connessione e di chiusura del db
				$conn = db_connect(); // mi connetto al db
				$s = "SELECT username, nome, cognome, genere, tipo, universita, somma FROM utenti WHERE username='$user'"; // seleziono dalla tabella utenti tutte le colonne tranne la password in cui l'username corrisponde a quello dell'utente
				$ris = mysqli_query($conn, $s); // eseguo la query
				$riga = mysqli_fetch_assoc($ris); // recupera la riga dei risultati come array associativo
				$nome = $riga["nome"]; // prendo il contenuto della riga di ciascuna prorpietà e lo assegno a delle variabili
				$cognome = $riga["cognome"];
				$genere = $riga["genere"];
				$tipo = $riga["tipo"];
				$universita = $riga["universita"];
				$somma = $riga["somma"];
				echo "<table id='center'>";
				echo "<tr><th>Username</th><th>Nome</th><th>Cognome</th><th>Genere</th><th>Evento preferito</th><th>Università</th><th>Totale cfu conseguiti</th></tr>";
				echo "<tr><td> " . $user . "</td>"; // stampo in una tabella i dati dell'utente
				echo "<td> " . $nome . "</td>";
				echo "<td> " . $cognome . "</td>";
				echo "<td> " . $genere . "</td>";
				echo "<td> " . $tipo . "</td>";
				echo "<td> " . $universita . "</td>";
				echo "<td> " . $somma . "</td>";
				echo "</tr></table><br>"
				?>
			</fieldset><br>
			<fieldset>
				<h2>Vuoi eliminare il tuo account?</h2><br>
				<form action="user-delete-user.php" method="post" name="login">
					<p id="red"><b>Username o password errati! Riprova.</b></p>
					<label for="pwd"><b>Password</b></label><br>
					<input type="password" id="delete-pwd" name="delete-pwd" placeholder="Password" required><br><br>
					<input type="submit" value="Elimina account">
				</form>
			</fieldset><br>
			<h2>Clicca qui per effettuare il logout</h2><br>
			<form action="logout.php" method="post" name="login">
				<input type="submit" value="Logout">
			</form><br>
		</div>
	</header>
	<?php
include 'common/footer.html';
?>