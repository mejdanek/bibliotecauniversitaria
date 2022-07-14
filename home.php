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
        <!--LogoICT-->
        <a href="home.php"><img id="left2" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
        <!--Titolo-->
        <h1>Biblioteca universitaria: cultura e studio per tutti gli studenti</h1><br><br><br>
      </header>
      
      <p>Benvenuto matricola nr. <b><?php echo $matricola; ?></b>
        <form action="logout.php" method="post" name="logout">
          <input type="submit" value="Logout">
        </form>
</p>
    </div>
  </main>
  <?php
  include 'common/footer.html';
  ?>