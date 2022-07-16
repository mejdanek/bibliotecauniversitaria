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
<script>
  $(function() { // il codice incluso verrà eseguito solo quando la pagina DOM è pronta per l'esecuzione del codice JavaScript

    // read
    on_read = function() {
      $.ajax({
        url: "http://localhost/bibliotecauniversitaria/rest/read.php", // specifica l'URL a cui inviare la richiesta
        type: "GET", // specifica il titolo di richiesta
        success: function(response) { // response = lista di libri (array di oggetti JSON). Success è la funzione che verrà eseguita in caso di successo 
          // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
          html_table = `<table id='center'>
						<tr>
							<th>ISBN</th>
							<th>Titolo</th>
							<th>Autore</th>
							<th>Editore</th>
							<th>Giacenza</th>
              <th>Prenota</th>
						</tr>`;
          for (i = 0; i < response.libri.length; i++) { // ciclo for per ciclare sull'array
            isbn = response.libri[i].isbn; // prendo i valori delle proprietà di ogni singolo libro
            titolo = response.libri[i].titolo;
            autore = response.libri[i].autore;
            editore = response.libri[i].editore;
            giacenza = response.libri[i].giacenza;

            id_reserve = response.libri[i].isbn;
            html_table += "<tr><td>" + isbn + "</td><td> " + titolo + "</td><td> " + autore + "</td><td> " + editore + "</td><td> " + giacenza + "</td><td><input type='image' class='create-assign-button' src='images/check.gif' value='" + id_reserve + "'></td></tr>";
          }
          html_table += "</table>";
          $("#libri").html(html_table); // inserisco la tabella degli libri nel div #libri
          $(".create-assign-button").on("click", on_bookreserve); // all'on click del cestino parte la funzione on_bookreturn()
          $("#read-all").on("submit", on_read); // all'on submit del pulsante #read-all parte la funzione on_read()
        },
        error: function(xhr, err, exc) { // error verrà eseguita in caso di errore
          // stampo l'errore sulla console
          console.log(xhr, err, exc);
        }
      });
      return false; // necessario per far funzionare l'on submit (senza parte la request legata all'attributo href)
    }
    on_read(); // all'apertura della pagina admin-page.php parte la funzione on_read()

    on_read_user = function() {
      $.ajax({
        url: "http://localhost/bibliotecauniversitaria/rest/read_assign.php?matricola=<?php echo $matricola; ?>", // specifica l'URL a cui inviare la richiesta
        type: "GET", // specifica il titolo di richiesta
        success: function(response) { // response = lista di libri (array di oggetti JSON). Success è la funzione che verrà eseguita in caso di successo 
          // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
          html_table = `<table id='center'>
						<tr>
							<th>ISBN</th>
							<th>Titolo</th>
							<th>Autore</th>
							<th>Editore</th>
						</tr>`;
          for (i = 0; i < response.libri.length; i++) { // ciclo for per ciclare sull'array
            isbn = response.libri[i].isbn; // prendo i valori delle proprietà di ogni singolo libro
            titolo = response.libri[i].titolo;
            autore = response.libri[i].autore;
            editore = response.libri[i].editore;
            id_return = response.libri[i].isbn;
            id_reserve = response.libri[i].isbn;
            html_table += "<tr><td>" + isbn + "</td><td> " + titolo + "</td><td> " + autore + "</td><td> " + editore + "</td><td><input type='image' class='delete-assign-button' src='images/cestino.png' value='" + id_return + "'></td></tr>";
          
            }
          html_table += "</table>";
          $("#libriutente").html(html_table); // inserisco la tabella degli libri nel div #libri
          $(".delete-assign-button").on("click", on_bookreturn); // all'on click del cestino parte la funzione on_bookreturn()
          $("#read-all").on("submit", on_read); // all'on submit del pulsante #read-all parte la funzione on_read()
        },
        error: function(xhr, err, exc) { // error verrà eseguita in caso di errore
          // stampo l'errore sulla console
          console.log(xhr, err, exc);
        }
      });
      return false; // necessario per far funzionare l'on submit (senza parte la request legata all'attributo href)
    }
    on_read_user();

    // delete
    on_delete = function(event) {
      /**
       * A differenza delle altre, la callback "on_delete" utilizza il parametro in ingresso "event"
       * associato all'elemento html cliccato (ovvero il cestino). Serve "event" perché in questo caso
       * è presente un cestino per ogni riga, quindi quando si invoca questa callback è necessario
       * capire in che riga si è cliccato.
       * In dettaglio, il "event.target.value" corrisponde all'id dell'libri che si vuole eliminare, poiché
       * è stato così settato in fase di read (si veda la callback "on_read").
       */
      conf = confirm("Sei sicuro di voler eliminare questo libri?"); // finestra di dialogo per confermare la cancellazione di un libri
      if (conf) { // se l'utente clicca sì parte la chiamata ajax per il servizio delete
        $.ajax({
          url: "http://localhost/bibliotecauniversitaria/rest/delete.php?isbn=" + event.target.value, // specifica l'URL a cui inviare la richiesta
          type: "DELETE", // specifica il autore di richiesta
          contentType: 'application/json', // il autore di contenuto utilizzato durante l'invio di dati al server
          success: function(response) { // // response = messaggio. Success è la funzione che verrà eseguita in caso di successo 
            // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
            alert("libri eliminato!");
            on_read(); // dopo aver eliminato l'libri parte la funzione on_read() per leggere nuovamente tutti gli libri 
          },
          error: function(xhr, err, exc) { // error verrà eseguita in caso di errore
            // stampo l'errore sulla console
            console.log(xhr, err, exc);
          }
        });
        return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
      }
    }

    // search
    $("#search-form").on("submit", function() { // al submit della barra di ricerca...
      var s_search = $("#search-form").find("input[name='search']").val(); // prendo la keyowrd inserita dall'utente nell'input 
      $.ajax({
        url: "http://localhost/bibliotecauniversitaria/rest/search.php?s=" + s_search, // specifica l'URL a cui inviare la richiesta
        type: "GET", // specifica il autore di richiesta
        success: function(response) { // response = lista di libri (array di oggetti JSON). Success è la funzione che verrà eseguita in caso di successo 
          // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
          html_table = `<table id='center'>
						<tr>
							<th>ISBN</th>
							<th>Titolo</th>
							<th>Autore</th>
							<th>Editore</th>
							<th>Giacenza</th>
						</tr>`;
          if (response.libri.length > 0) { // se la response restituisce qualche libri
            for (i = 0; i < response.libri.length; i++) { // ciclo for sull'array response
              titolo = response.libri[i].titolo; // prendo i valori delle proprietà di ogni singolo libri
              autore = response.libri[i].autore;
              editore = response.libri[i].editore;
              id_delete = response.libri[i].isbn;
              html_table += "<tr><td>" + titolo + "</td><td> " + autore + "</td><td> " + editore + "</td><td><input type='image' class='delete-button' src='images/cestino.png' value='" + id_delete + "'></td></tr>";
            }
          } else {
            html_table += `<tr>
							<td colspan='4'>Nessun risultato per "${s_search}"</td>
							</tr>`;
          }
          html_table += "</table>";
          $("#libri").html(html_table); // inserisco la tabella nel div #libri
          $(".delete-button").on("click", on_delete); // all'on click del cestino parte la funzione on_delete()
          $("#read-all").on("submit", on_read); // all'on submit dell pulsante #read-all parte la funzione on_read()
        },
        error: function(xhr, err, exc) { // error verrà eseguita in caso di errore
          // stampo l'errore sulla console
          console.log(xhr, err, exc);
        }
      });
      return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
    });

    // create
    on_create = function() {
      var formData = {}; // inizializzo un oggetto
      for (var form of $("#crealibri").serializeArray()) { // ciclo for per creare il body per la POST seguente a partire dai valori presenti nel form
        // il metodo serializeArray() crea un array di oggetti JavaScript, pronto per essere codificato come stringa JSON
        formData[form['name']] = form['value'];
      }
      $.ajax({
        url: "http://localhost/bibliotecauniversitaria/rest/create.php", // specifica l'URL a cui inviare la richiesta
        type: "POST", // specifica il autore di richiesta
        contentType: 'application/json', // il autore di contenuto utilizzato durante l'invio di dati al server
        dataType: "json", // il autore di dati previsto dalla risposta del server
        data: JSON.stringify(formData), // specifica i dati da inviare al server
        success: function(response) { // response = messaggio. Success è la funzione che verrà eseguita in caso di successo 
          // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
          alert("libri inserito!");
          on_read(); // dopo la creazione dell'libri parte la funzione on_read()
        },
        error: function(xhr, err, exc) { // error verrà eseguita in caso di errore
          // stampo l'errore sulla console
          console.log(xhr, err, exc);
        }
      });
      return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
    }

    on_bookreserve = function(){
      conf = confirm("Sei sicuro di voler prenotare questo libro?"); // finestra di dialogo per confermare la cancellazione di un'assegnazione
      var formData = {}; // inizializzo un oggetto
      for (var form of $("#crealibri").serializeArray()) { // ciclo for per creare il body per la POST seguente a partire dai valori presenti nel form
        // il metodo serializeArray() crea un array di oggetti JavaScript, pronto per essere codificato come stringa JSON
        formData[form['name']] = form['value'];
      }
      $.ajax({
        url: "http://localhost/bibliotecauniversitaria/rest/create-assign.php", // specifica l'URL a cui inviare la richiesta
        type: "POST", // specifica il autore di richiesta
        contentType: 'application/json', // il autore di contenuto utilizzato durante l'invio di dati al server
        dataType: "json", // il autore di dati previsto dalla risposta del server
        data: JSON.stringify(formData), // specifica i dati da inviare al server
        success: function(response) { // response = messaggio. Success è la funzione che verrà eseguita in caso di successo 
          // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
          alert("Assegnazione confermata!");
          on_read_user(); // dopo la creazione dell'libri parte la funzione on_read()
        },
        error: function(xhr, err, exc) { // error verrà eseguita in caso di errore
          // stampo l'errore sulla console
          console.log(xhr, err, exc);
        }
      });
      return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
    }
    
    on_bookreturn = function(){
      conf = confirm("Sei sicuro di voler eliminare questo libri?"); // finestra di dialogo per confermare la cancellazione di un'assegnazione
      if (conf) { // se l'utente clicca sì parte la chiamata ajax per il servizio delete
        $.ajax({
          url: "http://localhost/bibliotecauniversitaria/rest/delete_assign.php?isbn=" + event.target.value + "&matricola=" + "<?php echo $matricola; ?>", // specifica l'URL a cui inviare la richiesta
          type: "DELETE", // specifica il autore di richiesta
          contentType: 'application/json', // il autore di contenuto utilizzato durante l'invio di dati al server
          success: function(response) { // // response = messaggio. Success è la funzione che verrà eseguita in caso di successo 
            // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
            alert("libri eliminato!");
            on_read_user(); // dopo aver eliminato l'libri parte la funzione on_read() per leggere nuovamente tutti gli libri 
          },
          error: function(xhr, err, exc) { // error verrà eseguita in caso di errore
            // stampo l'errore sulla console
            console.log(xhr, err, exc);
          }
        });
        return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
      }
    }
    
    $("#crealibri").on("submit", on_create); // all'on submit del form #crealibri parte la funzione on_create()
  });
</script>

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
        <a href="user-page.php"><img id="left2" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
        <!--Titolo-->
        <h1>Biblioteca universitaria: cultura e studio per tutti gli studenti</h1><br><br><br>
      </header>

      <p>Benvenuto matricola nr. <b><?php echo $matricola; ?></b>
      <form action="logout.php" method="post" name="logout">
        <input type="submit" value="Logout">
      </form>
      </p>
      <!-- libri in carico all'utente -->
      <h2>I miei libri</h2>
      <div id="libriutente"></div>

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
        <form action="admin-update-user.php" method="post" name="modificapassword">
          <label for="oldpsw"><b>Vecchia password</b></label><br>
          <input type="text" name="oldpsw" placeholder="Vecchia password" required><br><br>
          <label for="newpsw"><b>Nuova password</b></label><br>
          <input type="text" name="newpsw" placeholder="Nuova password" required><br><br>
          <input type="submit" value="Cambia password"><br><br>
        </form>
      </fieldset>

      <!-- cambio indirizzo mail -->

      <fieldset>
        <h2>Cambio indirizzo mail</h2>
        <form action="admin-update-user.php" method="post" name="modificaemail">
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