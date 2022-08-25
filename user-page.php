<?php
session_start(); // inizio la sessione
$matricola = $_SESSION["matricola"]; // prendo le variabili di sessione
if (empty($matricola)) {  // se la variabile non è stata settata (è vuota)
  header("Location:login.html.php"); // reindirizzo l'utente alla pagina di login
  exit;
} else {
  //echo "<h2>Benvenuto/a $matricola!</h2>"; // altrimenti stampo una frase di bevenuto personalizzata
}
?>

<?php
include 'common/header.html';
?>
<script src="js/user-page.js" type="text/javascript"></script>


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
            <a class="nav-link active" href="login.html.php">Area utenti</a>
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
        <!--Titolo-->
        <h1>Benvenuto nell'area utente</h1><br><br><br>
      </header>
      <div id="utentebenvenuto">
        <table id="benvenuto">
          <td>
            <p>Benvenuto matricola nr. <b id="nrmatricola"><?php echo $matricola; ?></b></p>
          </td>
          <td>
            <form action="logout.php" method="post" name="logout">
              <input type="submit" value="Logout">
            </form>
          </td>
      </div>
      </table>
      <!-- libri in carico all'utente -->
      <h2>I miei libri</h2>

      <fieldset>
        <div id="libriutente"></div>
        <br><br>
      </fieldset>

      <!-- tutti i libri disponibili -->
      <h2>Lista libri disponibili</h2>

      <fieldset>

        <div id="search-row">
          <form id="search-form" method="post" name="search-form">
            <input type="text" name="search" placeholder="Cerca...">
            <input type="image" src="images/search.png" value="Cerca" id="search-button">
          </form>
          <form id='read-all' name='read-all'>
            <input type='submit' value='Mostra tutti i libri'>
            <input type='hidden' name='matricola' value='<?php echo $matricola; ?>'>
            <!--mostra tutti gli libri in precedenza-->
          </form>
        </div>
        <br><br>
        <div id="libri"></div><br><br>
        <!--libri in precedenza-->
      </fieldset>

      <!-- cambio password -->

      <fieldset>
        <h2>Cambio password</h2>
        <form action="user-change-psw.php" method="post" name="modificapassword">
          <label for="oldpsw"><b>Vecchia password</b></label><br>
          <input type="password" name="oldpsw" placeholder="Vecchia password" required><br><br>
          <label for="newpsw"><b>Nuova password</b></label><br>
          <input type="password" name="newpsw" placeholder="Nuova password" required><br><br>
          <input type="submit" value="Cambia password"><br><br>
        </form>
      </fieldset>

      <!-- cambio indirizzo mail -->

      <fieldset>
        <h2>Cambio indirizzo mail</h2>
        <form action="user-change-mail.php" method="post" name="modificaemail">
          <label for="oldemail"><b>Vecchio indirizzo</b></label><br>
          <input type="text" name="oldemail" placeholder="Vecchio indirizzo" required><br><br>
          <label for="newemail"><b>Nuovo indirizzo</b></label><br>
          <input type="text" name="newemail" placeholder="Nuovo indirizzo" required><br><br>
          <input type="submit" value="Modifica indirizzo"><br><br>
        </form>
      </fieldset>

    </div>
  </main>
  <?php
  include 'common/footer.html';
  ?>
  <script>
    // all'apertura della pagina vengono avviate le funzioni on_read() e on_read_user()
    $(function() {
      var matricola = $('#nrmatricola').text();
      on_read();
      on_read_user(matricola);
    });
  </script>