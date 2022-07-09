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
		<!--LogoICT-->
		<a href="index.php"><img id="left" src="images/logo.png" width="200" alt="logo"
				title="Logo#CPS/external link"></a>
		<!--Titolo-->
		<h1>Cancellazione effettuata correttamente!<br><br> <img src="images/check.gif" alt="check" title="Check"
				width="100"></h1><br>
		<p id="p01"><a href="admin-home.php" title="internal link">Torna all'Admin Area</a></p>
	</header>
	<br><br><br><br><br>
		</div>
	  </main>
	<?php
	include 'common/footer.html';
	?>