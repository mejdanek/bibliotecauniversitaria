<?php
session_start(); // inizio la sessione
$matricola = $_SESSION["matricola"]; // prendo le variabili di sessione
if (empty($matricola)) {  // se la variabile non è stata settata (è vuota)
	header("Location:login.html.php"); // reindirizzo l'utente alla pagina di login
	exit;
} else {
	echo "<h2>Benvenuto/a $matricola!</h2>"; // altrimenti stampo una frase di bevenuto personalizzata
}
?>
<?php
include 'common/header.html';
?>

<body>
	<!--Barra di navigazione-->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
      <div class="container">
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout (matr. <?php echo $_SESSION['matricola']; ?>)</a>
            </li>
            <li class="nav-item"><a></a></li>
            <li class="nav-item">
              <a class="nav-link" href="admin-login.html.php">Area admin</a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>
    <main role="main" class="container">
		<div class="jumbotron">
	<header>
		<!--LogoICT-->
		<a href="home.php"><img id="left2" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
		<!--Titolo-->
		<h1>Biblioteca universitaria: cultura e studio per tutti gli studenti</h1><br><br><br>
	</header>
	<!--Immagine Torino-->
	<div id="center"><img src="images/torino.gif" width="750" alt="Torino" title="Immagine panorama Torino"><br><br></div>
	<div id="main">
		<!--Inizio contenuto della pagina-->
		<p id="p01">Vi presentiamo la  <strong>"biblioteca universitaria"</strong>?<br>La Biblioteca Universitaria offre un servizio per tutti gli studenti dell'Università di Torino che hanno 
            bisogno di reperire testi, materiale per la preparazione dei loro esami oppure della loro tesi.<br><br>
			Quello che ci contraddistingue è la passione per i libri e prenderci cura di loro. Il nostro obiettivo
            è quello di offrire un servizio che possa soddisfare tutti gli studenti ed inoltre metteremo a disposizione
            le aree comuni per far si che tutti i ragazzi possano studiare direttamente nella biblioteca con i loro compagni di corso.
            Gli studenti potranno così incrementare le loro sfera della conoscenza, socializzazione, informazione e divertimento.
            Per conoscere <b>opportunità </b>, <b>agevolazioni</b> e le <b>offerte rivolte agli studenti</b> di Torino
            è possibile visitare il nostro sito: <a href="https://www.unito.it/ateneo/strutture-e-sedi/strutture/biblioteche" title="external link" target="_blank">"Biblioteca Universitaria"</a>. <br> <br>
			
		</p>
	</div>
  <h2>Clicca qui per effettuare il logout:</h2><br><br>
				<div id="center">
					<form action="logout.php" method="post" name="logout">
						<input type="submit" value="Logout">
					</form>
				</div>
				<br>
    </div>
    </main>
	<?php
include 'common/footer.html';
?>