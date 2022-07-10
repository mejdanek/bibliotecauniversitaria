<?php
session_start(); // inizio la sessione
$matricola = $_SESSION["matricola"]; // prendo la variabile di sessione
if (empty($user)) { // se la variabile di sessione non è stata settata (è vuota)
	header("Location:login.html.php"); // reindirizzo l'utente alla pagina di login
	exit;
} else { // altrimenti prendo i dati dell'evento scelti dall'utente
	include_once 'db-connect-db-close.php'; // includo il file di connessione e di chiusura del db
	$conn = db_connect(); // mi connetto al db
	$nome = mysqli_real_escape_string($conn, $_POST["nome"]);  // eseguendo l'escape dei caratteri speciali
	$tipo = $_POST["tipo"];
	$citta = mysqli_real_escape_string($conn, $_POST["citta"]);
}
?>
<?php
include 'common/header.html';
?>

<body>
	<!--Nav Bar-->
	<nav>
		<ul id="menu">
			<li><a href="home.php">Home</a></li>
			<li><a class="active" href="user-search-events.html.php">Cerca eventi</a></li>
			<li style="float:right"><a href="user-profile.php">Pagina Utente</a></li>
		</ul>
	</nav>
	<header>
		<!--LogoICT-->
		<a href="home.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
	</header>
	<!--Immagine destra-->
	<div id="right"><img src="images/lente.png" alt="cerca" title="Lente" width="200"></div><br><br><br>
	<div id='center'>
		<?php
		echo "<h1>Stai cercando: " . $tipo . "!</h1><br><br><br>"; // stampo il tipo di evento selezionato
		$s = "SELECT nome, tipo, citta FROM eventi WHERE nome LIKE '%$nome%' AND tipo='$tipo' AND citta LIKE '%$citta%'"; // seleziono le colonne nome e citta dalla tabella evento in cui il nome, la città e il tipo corrispondono ai dati scelti dall'utente
		$ris = mysqli_query($conn, $s); // eseguo la query
		$n = mysqli_num_rows($ris); // prendo il numero di righe del risultato della query
		if ($n > 0) { // se ci sono righe (ci sono eventi)
			echo "<fieldset><h2>Gli eventi di tipo '" . $tipo . "' disponibili sono:</h2>"; // stampo il tipo di evento selezionato
			echo "<table id='center'>";
			echo "<tr><th>Nome evento</th><th>Tipo</th><th>Città</th><th></th></tr>";
			for ($i = 0; $i < $n; $i++) { // ciclo sulle righe selezionate
				$row = mysqli_fetch_assoc($ris); // recupero una riga del risultato come array associativo
				$nome = $row["nome"]; // prendo il contenuto della riga di ciascuna prorpietà e lo assegno a delle variabili
				$tipo = $row["tipo"];
				$citta = $row["citta"];
				echo "<form id='choice' method='post' action='user-event-choice.php'>";
				echo "<tr><td>" . $nome . "</td>"; // stampo in una tabella i dati degli eventi e i radio button
				echo "<td> " . $tipo . "</td>";
				echo "<td> " . $citta . "</td>";
				echo "<td><input type='radio' id='scelta' name='scelta' value='" . $nome . " " . $tipo . " " . $citta . "' required></td>";
				echo "</tr>";
			}
			echo "</table><br>";
			echo "<input type='submit' id='go' value='Scegli evento!'><br><br>";
			echo "</form>";
		} else {
			echo "<h1>Nessun risultato!</h1>"; // altrimento stampo la stringa "nessun risultato" e il pulsante 
			echo "<form id='back' action='user-search-events.html.php' method=''post'>";
			echo "<input type='submit' id=''back-button' value='Torna indietro'>";
			echo "</form>";
		}
		?>
		<form id="back" action="user-search-events.html.php" method="post">
			<input type='submit' id='back-button' name='action' value='Torna indietro'>
		</form>
		</fieldset>
	</div><br><br>
	<?php
include 'common/footer.html';
?>