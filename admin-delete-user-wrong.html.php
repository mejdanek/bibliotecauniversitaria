<?php
session_start(); // inizio la sessione
$adminuser = $_SESSION["adminuser"]; // prendo la variabile di sessione
if (empty($adminuser)) { // se la variabile non è stata settata (è vuota)
    header("Location:../tec_web/admin-login.html.php"); // reindirizzo l'utente alla pagina di login
    exit;
}
?>
<!DOCTYPE html>
<html lang="it-IT">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Tempo libero: eventi culturali e sportivi per studenti">
    <meta name="keywords" content="Eventi, attività, cultura, sport, tempo libero, studenti.">
    <meta name="author" content="Alessia Aniceto">
    <title>Admin Area</title>
    <link rel="stylesheet" type="text/css" href="stylesheet/styles.css">
    <script src="jquery-3.4.1.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script>
        jQuery(document).ready(function() {

            // ***** read
            on_read = function() {
                $.ajax({
                    url: "http://localhost/REST/api_server/api/read.php",
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
                        url: "http://localhost/REST/api_server/api/delete.php?id=" + event.target.value,
                        type: "DELETE",
                        contentType: 'application/json', // content-type dei dati della request
                        success: function(response) { // response = messaggio
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
                    url: "http://localhost/REST/api_server/api/search.php?s=" + s_search,
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
                    url: "http://localhost/REST/api_server/api/create.php",
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
</head>

<body>
    <!--Barra di navigazione-->
    <nav>
        <ul id="menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="login.html.php">Area Utenti</a></li>
            <li style="float:right"><a class="active" href="admin-home.php">Admin Area</a></li>
        </ul>
    </nav>
    <header>
        <!--LogoICT-->
        <a href="index.html"><img id="left" src="images/logo.png" width="200" alt="logo" title="Logo#CPS/external link"></a>
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
            <h2>Cerca eventi</h2><br>
            <div id="search-row">
                <form id="search-form" method="post" name="search-form">
                    <input type="text" name="search" placeholder="Cerca...">
                    <input type="image" src="images/search.png" value="Cerca" id="search-button">
                </form>
                <form id='read-all' name='read-all'>
                    <input type='submit' value='Mostra tutti gli eventi'>
                </form>
            </div>
            <br><br>
            <div id="eventi"></div><br><br>
        </fieldset>
        <br>

        <fieldset>
            <h2>Aggiungi evento</h2><br>
            <form id="creaevento" method="post" name="aggiungieventi">
                <label for="nome"><b>Nome Evento</b></label><br>
                <input type="text" name="nome" placeholder="Nome Evento" required><br><br>
                <label for="citta"><b>Città Evento</b></label><br>
                <input type="text" name="citta" placeholder="Città Evento" required><br><br>
                <label for="tipo"><b>Tipo Evento</b></label><br>
                <select name="tipo" id="tipo" required>
                    <option hidden disabled selected value> -- seleziona un'opzione -- </option>
                    <option value="Concerti">Concerti</option>
                    <option value="Cinema">Cinema</option>
                    <option value="Teatro">Teatro</option>
                    <option value="Musei">Musei</option>
                </select><br><br>
                <input type="submit" id="create" value="Aggiungi"><br><br>
            </form>
        </fieldset>
        <br>

        <fieldset>
            <h2>Elimina Utenti</h2><br>
            <form action="admin-delete-user.php" method="post" name="eliminauser">
                <p id="red"><b>User errato! Riprova</b></p>
                <label for="user"><b>Inserire Username da eliminare:</b></label><br>
                <input type="text" name="user" placeholder="Inserisci Username da eliminare" required><br><br>
                <input type="submit" value="Elimina Utente"><br><br>
            </form>
        </fieldset>
        <br>

        <fieldset>
            <h2>Modifica Username</h2><br>
            <form action="admin-update-user.php" method="post" name="modificauser">
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

        <footer>
            <p id="p04">&copy; Copyright 2021. Tutti i diritti riservati.<br><b>Powered by Alessia Aniceto</b></p>
        </footer>
    </div>
</body>

</html>