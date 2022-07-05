<?php
session_start(); // inizio la sessione
if (isset($_SESSION["user"])) { // se la variabile di sessione è settata
	$user = $_SESSION["user"]; // prendo la variabile di sessione
	if (!empty($user)) { // se la variabile di sessione non è vuota
		header("Location:home.php"); // reindirizzo l'utente alla home
		exit;
	}
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
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
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


	<main role="main" class="container">
		<div class="jumbotron">
			<header>
				<!--LogoICT-->
				<a href="index.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
				<!--Titolo-->
				<h1>Accedi ai servizi</h1><br><br><br>
			</header>
			<!--Immagine destra-->
			<div id="right"><img src="images/chiave.png" alt="chiave" title="Login" width="190"></div><br><br><br><br><br>
			<!--Inizio form-->
			<div id="center">
				<form action="login.php" method="post" name="login">
					<fieldset><br>
						<label for="user"><b>Username</b></label><br>
						<input type="text" id="user" name="user" placeholder="Username" required><br><br>
						<label for="pwd"><b>Password</b></label><br>
						<input type="password" id="pwd" name="pwd" placeholder="Password" required><br><br>
						<input type="submit" value="Entra!">
					</fieldset>
				</form>
				<p id="p01">Sei un nuovo utente?<br><a href="registration.html"><b>Registrati!</b></a></p>
			</div>
		</div>
	</main>

	<?php
	include 'common/footer.html';
	?>