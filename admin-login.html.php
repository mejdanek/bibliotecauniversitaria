<?php
session_start(); // inizio la sessione
if (isset($_SESSION["adminuser"])) { // se la variabile di sessione è settata
	$adminuser = $_SESSION["adminuser"]; // prendo la variabile di sessione
	if (!empty($adminuser)) { // se la variabile di sessione non è vuota
		header("Location:admin-home.php"); // reindirizzo l'admin alla admin-home
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
					<li class="nav-item">
						<a class="nav-link" href="login.html.php">Login utenti</a>
					</li>
					<li class="nav-item"><a></a></li>
					<li class="nav-item active">
						<a class="nav-link" href="admin-login.html.php">Login admin</a>
					</li>
				</ul>

			</div>
		</div>
	</nav>



	<main role="main" class="container">
		<div class="jumbotron">
			<header>
				<br>
				<!--LogoICT-->
				<a href="index.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
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
		</div>
	</main>

	<?php
	include 'common/footer.html';
	?>