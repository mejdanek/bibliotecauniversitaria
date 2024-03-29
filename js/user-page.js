// quando la pagina è caricata completamente...
$(function () {

    on_read = function () {
        $.ajax({
            url: "http://localhost/bibliotecauniversitaria/rest/read_available.php", // specifica l'URL a cui inviare la richiesta
            type: "GET", // specifica il titolo di richiesta
            success: function (response) { // response = lista di libri (array di oggetti JSON). Success è la funzione che verrà eseguita in caso di successo 
                // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
                html_table = "<table id='listalibri'><tr><th>ISBN</th><th>Titolo</th><th>Autore</th><th>Editore</th><th>Giacenza</th><th>Prenota</th></tr>";
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
            error: function (xhr, err, exc) {
                // in caso di errore, viene mostrato sulla console
                console.log(xhr, err, exc);
            }
        });
        return false; // necessario per far funzionare l'on submit (senza parte la request legata all'attributo href)
    }

    on_read_user = function () {
        $.ajax({
            url: "http://localhost/bibliotecauniversitaria/rest/read_assign.php?matricola=" + $('#nrmatricola').text(), // specifica l'URL a cui inviare la richiesta
            type: "GET", // specifica il titolo di richiesta
            success: function (response) { // response = lista di libri (array di oggetti JSON). Success è la funzione che verrà eseguita in caso di successo 
                // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
                if (response.message === 'Nessun libro trovato') {
                    html_table = "<p>Nessun libro in carico</p>";
                    $("#libriutente").html(html_table);
                } else {
                    html_table = "<table id='center'><tr><th>ISBN</th><th>Titolo</th><th>Autore</th><th>Editore</th><th>Restituisci</th></tr>";
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
                }
            },
            error: function (xhr, err, exc) {
                // in caso di errore, viene mostrato sulla console
                console.log(xhr, err, exc);
            }
        });
        return false; // necessario per far funzionare l'on submit (senza parte la request legata all'attributo href)
    }

    on_delete = function (event) {
        // il parametro event consente di capire quale dei libri si vuole cancellare
        conf = confirm("Sei sicuro di voler eliminare questo libro?"); // finestra di dialogo per confermare la cancellazione di un libri
        if (conf) { // se l'utente clicca sì parte la chiamata ajax per il servizio delete
            $.ajax({
                url: "http://localhost/bibliotecauniversitaria/rest/delete.php?isbn=" + event.target.value, // specifica l'URL a cui inviare la richiesta
                type: "DELETE", // specifica il autore di richiesta
                contentType: 'application/json', // il autore di contenuto utilizzato durante l'invio di dati al server
                success: function (response) { // // response = messaggio. Success è la funzione che verrà eseguita in caso di successo 
                    // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
                    alert("libro eliminato!");
                    on_read(); // dopo aver eliminato l'libri parte la funzione on_read() per leggere nuovamente tutti gli libri 
                },
                error: function (xhr, err, exc) {
                    // in caso di errore, viene mostrato sulla console
                    console.log(xhr, err, exc);
                }
            });
            return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
        }
    }

    on_create = function () {
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
            success: function (response) { // response = messaggio. Success è la funzione che verrà eseguita in caso di successo 
                // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
                alert("Libro inserito correttamente!");
                on_read(); // dopo la creazione dell'libri parte la funzione on_read()
            },
            error: function (xhr, err, exc) {
                // in caso di errore, viene mostrato sulla console
                console.log(xhr, err, exc);
            }
        });
        return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
    }

    on_bookreserve = function (event) {
        conf = confirm("Sei sicuro di voler prenotate questo libro?"); // finestra di dialogo per confermare la cancellazione di un libri
        if (conf) { // se l'utente clicca sì parte la chiamata ajax per il servizio delete
            $.ajax({
                url: "http://localhost/bibliotecauniversitaria/rest/create_assign.php?isbn=" + event.target.value + "&matricola=" + $('#nrmatricola').text(), // specifica l'URL a cui inviare la richiesta
                type: "GET", // specifica il autore di richiesta
                contentType: 'application/json', // il autore di contenuto utilizzato durante l'invio di dati al server
                success: function (response) { // // response = messaggio. Success è la funzione che verrà eseguita in caso di successo 
                    // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
                    alert("Libro prenotato correttamente!");
                    on_read(); // dopo aver eliminato l'libri parte la funzione on_read() per leggere nuovamente tutti gli libri 
                    on_read_user();
                },
                error: function (xhr, err, exc) {
                    // in caso di errore, viene mostrato sulla console
                    console.log(xhr, err, exc);
                }
            });
            return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
        }
    }

    on_bookreturn = function (event) {
        conf = confirm("Sei sicuro di voler eliminare questo libri?"); // finestra di dialogo per confermare la cancellazione di un'assegnazione
        if (conf) { // se l'utente clicca sì parte la chiamata ajax per il servizio delete
            $.ajax({
                url: "http://localhost/bibliotecauniversitaria/rest/delete_assign.php?isbn=" + event.target.value + "&matricola=" + $('#nrmatricola').text(), // specifica l'URL a cui inviare la richiesta
                type: "DELETE", // specifica il autore di richiesta
                contentType: 'application/json', // il autore di contenuto utilizzato durante l'invio di dati al server
                success: function (response) { // // response = messaggio. Success è la funzione che verrà eseguita in caso di successo 
                    // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
                    alert("Libro riconsegnato correttamente!");
                    on_read_user(); // dopo aver eliminato l'libri parte la funzione on_read() per leggere nuovamente tutti gli libri 
                    on_read();
                },
                error: function (xhr, err, exc) {
                    // in caso di errore, viene mostrato sulla console
                    console.log(xhr, err, exc);
                }
            });
            return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
        }
    }

    // search
    $("#search-form").on("submit", function () { // al submit della barra di ricerca...
        var s_search = $("#search-form").find("input[name='search']").val(); // prendo la keyowrd inserita dall'utente nell'input 
        $.ajax({
            url: "http://localhost/bibliotecauniversitaria/rest/search.php?s=" + s_search, // specifica l'URL a cui inviare la richiesta
            type: "GET", // specifica il autore di richiesta
            success: function (response) { // response = lista di libri (array di oggetti JSON). Success è la funzione che verrà eseguita in caso di successo 
                // della chiamata a cui passiamo come parametro response che rappresenta i dati restituiti dal server web
                html_table = "<table id='center'><tr><th>ISBN</th><th>Titolo</th><th>Autore</th><th>Editore</th><th>Giacenza</th></tr>";
                if (response.libri.length > 0) { // se la response restituisce qualche libri
                    for (i = 0; i < response.libri.length; i++) { // ciclo for sull'array response
                        titolo = response.libri[i].titolo; // prendo i valori delle proprietà di ogni singolo libri
                        autore = response.libri[i].autore;
                        editore = response.libri[i].editore;
                        id_delete = response.libri[i].isbn;
                        html_table += "<tr><td>" + titolo + "</td><td> " + autore + "</td><td> " + editore + "</td><td><input type='image' class='delete-button' src='images/cestino.png' value='" + id_delete + "'></td></tr>";
                    }
                } else {
                    html_table += "<tr><td colspan='4'>Nessun risultato per "+s_search+"</td></tr>";
                }
                html_table += "</table>";
                $("#libri").html(html_table); // inserisco la tabella nel div #libri
                $(".delete-button").on("click", on_delete); // all'on click del cestino parte la funzione on_delete()
                $("#read-all").on("submit", on_read); // all'on submit dell pulsante #read-all parte la funzione on_read()
            },
            error: function (xhr, err, exc) {
                // in caso di errore, viene mostrato sulla console
                console.log(xhr, err, exc);
            }
        });
        return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
    });

    $("#crealibri").on("submit", on_create); // all'on submit del form #crealibri parte la funzione on_create()
});