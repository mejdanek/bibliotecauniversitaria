<?php
session_start(); // inizio la sessione
$adminuser = $_SESSION["adminuser"]; // prendo la variabile di sessione
if (empty($adminuser)) { // se la variabile di sessione non è stata settata (è vuota)
    header("Location:admin-login.html.php"); // reindirizzo l'admin alla pagina di login
    exit;
}
?>
<?php
include 'common/header.html';
?>

    <script>
        jQuery(document).ready(function() {

            // ***** read
            on_read = function() {
                $.ajax({
                    url: "http://localhost/bibliotecauniversitaria/rest/read.php",
                    type: "GET",
                    success: function(response) { // response = lista di eventi (array di oggetti JSON)
                        html_table = `<table id='center'>
						<tr>
							<th>Nome</th>
							<th>Città</th>
							<th>Tipo</th>
							<th></th>
						</tr>`;
                        for (i = 0; i < response.evento.length; i++) {
                            nome = response.evento[i].nome;
                            citta = response.evento[i].citta;
                            tipo = response.evento[i].tipo;
                            id_delete = response.evento[i].id;
                            html_table += "<tr><td>" + nome + "</td><td> " + citta + "</td><td> " + tipo + "</td><td><input type='image' class='delete-button' src='images/cestino.png' value='" + id_delete + "'></td></tr>";
                        }
                        html_table += "</table>";
                        $("#eventi").html(html_table);
                        $(".delete-button").on("click", on_delete);
                        $("#read-all").on("submit", on_read);
                    },
                    error: function(xhr, err, exc) {
                        // stampo l'errore sulla console
                        console.log(xhr, err, exc);
                    }
                });
                return false; // Necessario per far funzionare l'on click (senza parte la request legata all'attributo href e la chiamata ajax non funziona!)
            }
            on_read();



            // ***** delete
            on_delete = function(event) {
                /**
                 * A differenza delle altre, la callback "on_delete" utilizza il parametro in ingresso "event"
                 * associato all'elemento html cliccato (ovvero il cestino). Serve "event" perché in questo caso
                 * è presente un cestino per ogni riga, quindi quando si invoca questa callback è necessario
                 * capire in che riga si è cliccato.
                 * In dettaglio, il "event.target.value" corrisponde all'id dell'evento che si vuole eliminare, poiché
                 * è stato così settato in fase di read (si veda la callback "on_read").
                 */
                conf = confirm("Sei sicuro di voler eliminare questo evento?");
                if (conf) {
                    $.ajax({
                        url: "http://localhost/bibliotecauniversitaria/rest/delete.php?id=" + event.target.value,
                        type: "DELETE",
                        contentType: 'application/json', // content-type dei dati della request
                        success: function(response) { // response = messaggio. Success è la funzione che verrà eseguita in caso di successo 
                            // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
                            alert("Evento eliminato!");
                            on_read();
                        },
                        error: function(xhr, err, exc) {
                            // stampo l'errore sulla console
                            console.log(xhr, err, exc);
                        }
                    });
                    return false; // Necessario per far funzionare l'on click (senza parte la request legata all'attributo href e la chiamata ajax non funziona!)
                }
            }

            // ***** search
            $("#search-form").on("submit", function() {
                var s_search = $("#search-form").find("input[name='search']").val();
                $.ajax({
                    url: "http://localhost/bibliotecauniversitaria/rest/search.php?s=" + s_search,
                    type: "GET",
                    success: function(response) { // response = lista di eventi (array di oggetti JSON)
                        html_table = `<table id='center'>
						<tr>
							<th>Nome</th>
							<th>Città</th>
							<th>Tipo</th>
							<th></th>
						</tr>`;
                        if (response.eventi.length > 0) {
                            for (i = 0; i < response.eventi.length; i++) {
                                nome = response.eventi[i].nome;
                                citta = response.eventi[i].citta;
                                tipo = response.eventi[i].tipo;
                                id_delete = response.eventi[i].id;
                                html_table += "<tr><td>" + nome + "</td><td> " + citta + "</td><td> " + tipo + "</td><td><input type='image' class='delete-button' src='images/cestino.png' value='" + id_delete + "'></td></tr>";
                            }
                        } else {
                            html_table += `<tr>
							<td colspan='4'>Nessun risultato per "${s_search}"</td>
							</tr>`;
                        }
                        html_table += "</table>";
                        $("#eventi").html(html_table);
                        $(".delete-button").on("click", on_delete);
                        $("#read-all").on("submit", on_read);
                    },
                    error: function(xhr, err, exc) {
                        // stampo l'errore sulla console
                        console.log(xhr, err, exc);
                    }
                });
                return false; // Necessario per far funzionare l'on click (senza parte la request legata all'attributo href e la chiamata ajax non funziona!)
            });

            // ***** create
            on_create = function() {
                // Ciclo for per creare il body per la POST seguente a partire dai valori presenti nel form
                var formData = {};
                for (var form of $("#creaevento").serializeArray()) {
                    formData[form['name']] = form['value'];
                }
                $.ajax({
                    url: "http://localhost/bibliotecauniversitaria/rest/create.php",
                    type: "POST",
                    contentType: 'application/json', // content-type dei dati della request
                    dataType: "json",
                    data: JSON.stringify(formData),
                    success: function(response) { // response = messaggio
                        alert("Evento creato!");
                        on_read();
                    },
                    error: function(xhr, err, exc) {
                        // stampo l'errore sulla console
                        console.log(xhr, err, exc);
                    }
                });
                return false; // Necessario per far funzionare l'on click (senza parte la request legata all'attributo href e la chiamata ajax non funziona!)
            }
            $("#creaevento").on("submit", on_create);
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
    <header>
        <!--LogoICT-->
        <a href="index.php"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
        <!--Titolo-->
        <h1>Admin Area di
            <?php echo $adminuser ?>
        </h1>
    </header><br><br><br><br>
    <!--Immagine destra-->
    <div id="right">
        <img src="images/admin.png" alt="admin" title="Admin" width="190">
    </div><br>
    <!--Inizio form-->
    <div id="center">
        <fieldset>
            <h2>Cerca libri</h2><br>
            <div id="search-row">
                <form id="search-form" method="post" name="search-form">
                    <input type="text" name="search" placeholder="Cerca...">
                    <input type="image" src="images/search.png" value="Cerca" id="search-button">
                </form>
                <form id='read-all' name='read-all'>
                    <input type='submit' value='Mostra tutti i libri'>
                </form>
            </div>
            <br><br>
            <div id="libri"></div><br><br>
        </fieldset>
        <br>

        <fieldset>
            <h2>Aggiungi libro</h2><br>
            <form id="crealibro" method="post" name="aggiungilibro">
						<label for="titolo"><b>Titolo libro</b></label><br>
						<input type="text" name="titolo" placeholder="Inserire titolo" required><br><br>
						<label for="autore"><b>Autore libro</b></label><br>
						<input type="text" name="autore" placeholder="Inserire autore" required><br><br>
						<label for="editore"><b>Editore libro</b></label><br>
						<input type="text" name="editore" placeholder="Inserire editore" required><br><br>
						<label for="isbn"><b>Codice ISBN</b></label><br>
						<input type="text" name="isbn" placeholder="Inserire ISBN" required><br><br>
                <select name="tipo" id="tipo" required>
                    <option hidden disabled selected value> -- seleziona un'opzione -- </option>
                    <option value="Sociologia">Sociologia</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Comunicazione">Comunicazione</option>
                    <option value="Informatica">Informatica</option>
                </select><br><br>
                <input type="submit" id="create" value="Aggiungi"><br><br>
            </form>
        </fieldset>
        <br>

        <fieldset>
            <h2>Elimina Utenti</h2><br>
            <form action="admin-delete-user.php" method="post" name="eliminauser">
                <label for="user"><b>Inserire Username da eliminare:</b></label><br>
                <input type="text" name="user" placeholder="Inserisci Username da eliminare" required><br><br>
                <input type="submit" value="Elimina Utente"><br><br>
            </form>
        </fieldset>
        <br>

        <fieldset>
            <h2>Modifica Username</h2><br>
            <form action="admin-update-user.php" method="post" name="modificauser">
                <p id="red"><b>Dati errati! Riprova</b></p>
                <label for="olduser"><b>Vecchio Username</b></label><br>
                <input type="text" name="olduser" placeholder="Vecchio Username" required><br><br>
                <label for="newuser"><b>Nuovo Username</b></label><br>
                <input type="text" name="newuser" placeholder="Nuovo Username" required><br><br>
                <input type="submit" value="Modifica Username"><br><br>
            </form>
        </fieldset>
        <br>

        <h2>Clicca qui per effettuare il logout:</h2><br><br>
        <div id="center">
            <form action="admin-logout.php" method="post" name="logout">
                <input type="submit" value="Logout">
            </form>
        </div>
        <br>

        <?php
include 'common/footer.html';
?>