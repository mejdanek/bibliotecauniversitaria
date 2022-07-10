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
  <!--Nav Bar-->
  <!--Nav Bar-->
  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="login.html.php">Area utenti</a>
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
            <label for="matricola"><b>Nr. matricola</b></label><br>
            <input type="text" id="matricola" name="matricola" placeholder="Nr. martricola" required><br><br>
            <label for="email"><b>Indirizzo e-mail</b></label><br>
            <input type="email" id="email" name="email" placeholder="Indirizzo e-mail" required><br><br>
            <label for="pwd"><b>Password</b></label><br>
            <input type="password" id="pwd" name="password" placeholder="Password" required><br><br>
            <h4>Seleziona il tuo genere:</h4>
            <input type="radio" id="male" name="genere" value="M" required>
            <label for="male">Uomo</label><br>
            <input type="radio" id="female" name="genere" value="F" required>
            <label for="female">Donna</label><br><br>
            <input type="submit" value="Registrati!">
          </fieldset><br>
        </form>
      </div>
    </div>
  </main>
  <?php
  include 'common/footer.html';
  ?>