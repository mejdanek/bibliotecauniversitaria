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
	<header>
		<br>
		<!--LogoICT-->
		<a href="index.php"><img id="left" src="images/logo.png" width="200" alt="logo"
				title="Logo#CPS/external link"></a>
		<!--Titolo-->
		<h1>Admin Area</h1><br><br><br>
	</header>
	<!--Immagine destra-->
	<div id="right"><img src="images/admin.png" alt="admin" title="Admin" width="190"></div><br><br>
	<!--Inizio form-->
	<div id="center">
		<form action="admin-login.php" method="post" name="login">
			<fieldset>
				<p id="red"><b>Username o password errati! Riprova.</b></p>
				<label for="adminuser"><b>Username</b></label><br>
				<input type="text" id="adminuser" name="adminuser" placeholder="Username" required><br><br>
				<label for="adminpwd"><b>Password</b></label><br>
				<input type="password" id="adminpwd" name="adminpwd" placeholder="Password" required><br><br>
				<input type="submit" value="Entra"><br><br>
			</fieldset><br>
		</form>
	</div>

	<?php
	include 'common/footer.html';
	?>