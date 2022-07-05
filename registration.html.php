<?php
include 'common/header.html';
?>
    <script>
        jQuery(document).ready(function() { // il codice incluso verrà eseguito solo quando la pagina DOM è pronta per l'esecuzione del codice JavaScript
            $("#registration-form").on("submit", function() { // al submit del form
                var checkedArray = $("input[type='checkbox']:checked"); // prendo le checkbox selezionate e le inserisco in un array
                var somma = 0; // inizializzo una variabile a 0
                for (var i = 0; i < checkedArray.length; i++) { // ciclo for sulla lunghezza dell'array
                    var cfu = checkedArray[i].value; // prendo il valore di ciascuna checkbox selezionata
                    somma = somma + parseInt(cfu); // le sommo e le inserisco nella variabile
                }
                $("#somma").val(somma); // metto il valore contenuto nella variabile somma nell'input type hidden
            })
        })
    </script>


<body>
    <!--Barra di navigazione-->
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
        <br>
        <!--LogoICT-->
        <a href="index.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
        <!--Titolo-->
        <h1>Registrati</h1>
    </header><br><br>
    <!--Immagine destra-->
    <br>
    <div id="right"><img src="images/registrazione.png" alt="registrazione" title="Foglio con penna" width="200"></div>
    <br><br><br><br>
    <!--Inizio form-->
    <div id="center">
        <form id="registration-form" action="registration.php" method="post" name="registrazione">
            <fieldset><br>
                <label for="nome"><b>Nome</b></label><br>
                <input type="text" id="nome" name="nome" placeholder="Nome" required><br><br>
                <label for="cognome"><b>Cognome</b></label><br>
                <input type="text" id="cognome" name="cognome" placeholder="Cognome" required><br><br>
                <h3>Seleziona il tuo genere:</h3>
                <input type="radio" id="male" name="gender" value="Uomo" required>
                <label for="male">Uomo</label><br><br>
                <input type="radio" id="female" name="gender" value="Donna" required>
                <label for="female">Donna</label><br><br>
                <label for="tipo"><b>Seleziona il tuo evento preferito:</b></label><br>
                <select name="tipo" id="tipo" required>
					<option hidden disabled selected value> -- seleziona un'opzione -- </option>
					<option value="Concerti">Concerti</option>
					<option value="Cinema">Cinema</option>
					<option value="Teatro">Teatro</option>
					<option value="Musei">Musei</option>
				</select><br><br>
                <label for="university"><b>La tua università</b></label><br>
                <input type="text" id="university" name="university" placeholder="Università" required><br><br>
                <label for="check"><b>Esami sostenuti</b></label><br>
                <input type="checkbox" name="check" id="esame1" value="6">Esame 1: 6 cfu<br>
                <input type="checkbox" name="check" id="esame2" value="3">Esame 2: 3 cfu<br>
                <input type="checkbox" name="check" id="esame3" value="9">Esame 3: 9 cfu<br>
                <input type="checkbox" name="check" id="esame4" value="6">Esame 4: 6 cfu<br>
                <input type="checkbox" name="check" id="esame5" value="9">Esame 5: 9 cfu<br><br>
                <input type="hidden" name="somma" id="somma" value="somma">
                <label for="user"><b>Inserisci un username</b></label><br>
                <input type="text" id="user" name="user" placeholder="Username" required><br><br>
                <label for="pwd"><b>Inserisci una password</b></label><br>
                <input type="password" id="pwd" name="pwd" placeholder="Password" required><br><br>
                <input type="submit" value="Registrati!">
            </fieldset><br>
        </form>
    </div>
    </div>
      </main>
    <?php
	include 'common/footer.html';
	?>