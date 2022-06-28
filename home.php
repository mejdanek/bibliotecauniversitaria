<?php
session_start(); // inizio la sessione
$user = $_SESSION["user"]; // prendo le variabili di sessione
if (empty($user)) {  // se la variabile non è stata settata (è vuota)
	header("Location:login.html.php"); // reindirizzo l'utente alla pagina di login
	exit;
} else {
	echo "<h2>Benvenuto/a $user!</h2>"; // altrimenti stampo una frase di bevenuto personalizzata
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
              <a class="nav-link" href="login.html.php">Login utenti</a>
            </li>
            <li class="nav-item"><a></a></li>
            <li class="nav-item">
              <a class="nav-link" href="admin-login.html.php">Login admin</a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>
	<header>
		<!--LogoICT-->
		<a href="home.php"><img id="left2" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
		<!--Titolo-->
		<h1>Tempo libero: cultura e sport per studenti</h1><br><br><br>
	</header>
	<!--Immagine Torino-->
	<div id="center"><img src="images/torino.gif" width="750" alt="Torino" title="Immagine panorama Torino"><br><br></div>
	<div id="main">
		<!--Inizio contenuto della pagina-->
		<p id="p01">Cosa si intende per <strong>"tempo libero"</strong>?<br> Nell'accezione più ampia del termine si intendono tutte le attività ricreative scelte per <b>passione</b>;
			è implicito il legame con il concetto di <b>cura di sé</b>, con la sfera della <b>socializzazione</b>, del <b>divertimento</b>, della <b>conoscenza</b> e dell’<b>informazione</b>.<br><br>
			Il <b>2021</b> vedrà una Torino sempre più viva e dinamica. Il <b>programma</b> delle iniziative realizzato dalla Città e da Enti, Associazioni, Fondazioni e
			soggetti privati sarà infatti ricco di appuntamenti che toccheranno, nel corso dell’anno, diversi settori:
			dalla <b>cultura</b> al <b>turismo</b>, dallo <b>sport</b> alle <b>nuove tecnologie</b> e molto altro ancora.<br> Per saperne di più, visita il sito: <a href="https://www.guidatorino.com/eventi-torino-oggi/" title="external link" target="_blank">"Torino Eventi 2020"</a>.<br><br>
			Per conoscere <b>opportunità</b> e <b>agevolazioni</b> offerte agli studenti di <strong>Torino</strong>, puoi visitare la pagina <a href="https://www.unito.it/servizi/lo-sport-cultura-e-tempo-libero" title="external link" target="_blank">"Per lo sport, cultura e tempo libero"</a>.<br><br>
		</p>
	</div>
	<?php
include 'common/footer.html';
?>