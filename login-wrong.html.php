<?php
include 'common/header.html';
?>

<body>
	<!--Nav Bar-->
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
	<header>
		<br>
		<!--LogoICT-->
		<a href="index.php"><img id="left" src="images/logo.png" width="200" alt="logo"
				title="Logo#CPS/external link"></a>
		<!--Titolo-->
		<h1>Accedi ai servizi</h1><br><br><br>
	</header>
	<!--Immagine dx-->
	<div id="right"><img src="images/chiave.png" alt="chiave" title="Login" width="190"></div><br><br><br><br><br>
	<!--Inizio form-->
	<div id="center">
		<form action="login.php" method="post" name="login">
			<fieldset>
				<p id="red"><b>Username o password errati! Riprova.</b></p>
				<label for="user"><b>Username</b></label><br>
				<input type="text" id="user" name="user" placeholder="Username" required><br><br>
				<label for="pwd"><b>Password</b></label><br>
				<input type="password" id="pwd" name="pwd" placeholder="Password" required><br><br>
				<input type="submit" value="Entra!">
			</fieldset>
		</form>
		<p id="p01">Sei un nuovo utente?<br><a href="registration.html.php"><b>Registrati!</b></a></p>
	</div>

	<?php
	include 'common/footer.html';
	?>