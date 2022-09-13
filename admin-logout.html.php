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
	<center>
	<header>
		<!--Titolo-->
		<h1>Logout effettuato correttamente!<br><br> <img src="images/check.gif" alt="check" title="Check" width="100">
		</h1><br>
		<p id="p01"><a href="admin-login.html.php" title="internal link">Torna alla pagina di login</a></p>
	</header>
	</center>
	<br><br><br><br><br>
	</div>
	</main>
	<?php
	include 'common/footer.html';
	?>