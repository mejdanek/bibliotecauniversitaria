<?php
include 'common/header.html';
?>

<body>
	<!--Barra di navigazione-->
	<nav>
		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a class="active" href="login.html.php">Area Utenti</a></li>
		</ul>
	</nav>
	<header>
		<!--LogoICT-->
		<a href="index.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
		<!--Titolo-->
		<h1>Cancellazione effettuata correttamente!<br><br> <img src="images/check.gif" alt="check" title="Check" width="100"></h1><br>
		<p id="p01"><a href="login.html.php" title="internal link">Torna alla pagina di login</a></p>
	</header>
	<br><br><br><br><br>
	<?php
	include 'common/footer.html';
	?>