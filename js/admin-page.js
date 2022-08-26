// quando la pagina è caricata completamente...
$(function () {
    // funzione di lettura dei libri
    on_read = function () {
        $.ajax({
            url: "http://localhost/bibliotecauniversitaria/rest/read.php", // URL REST di lettura
            type: "GET", // specifica il tipo di richiesta
            success: function (response) { // response = lista di libri (array di oggetti JSON)
                // crea header tabella
                html_table = "<table id='center'><tr><th>ISBN</th><th>Titolo</th><th>Autore</th><th>Editore</th><th>Giacenza</th><th>Rimuovi</th></tr>";
                // recupera tutti i record dei libri
                for (i = 0; i < response.libri.length; i++) {
                    isbn = response.libri[i].isbn;
                    titolo = response.libri[i].titolo;
                    autore = response.libri[i].autore;
                    editore = response.libri[i].editore;
                    giacenza = response.libri[i].giacenza;
                    id_delete = response.libri[i].isbn;
                    // accoda i record nella tabella
                    html_table += "<tr><td>" + isbn + "</td><td> " + titolo + "</td><td> " + autore + "</td><td> " + editore + "</td><td> " + giacenza + "</td><td><input type='image' class='delete-button' src='images/cestino.png' value='" + id_delete + "'></td></tr>";
                }
                html_table += "</table>";
                // inserisce la tabella degli libri nel div #libri
                $("#libri").html(html_table);
                // all'onclick del cestino parte la funzione on_delete()
                $(".delete-button").on("click", on_delete); 
                // all'on submit del pulsante #read-all parte la funzione on_read()
                $("#read-all").on("submit", on_read); 
            },
            error: function (xhr, err, exc) {
                // in caso di errore, viene mostrato sulla console
                console.log(xhr, err, exc);
            }
        });
        return false; // necessario per far funzionare l'on submit (senza partirebbe la request legata all'attributo href)
    }

    // funzione di cancellazione dei libri
    on_delete = function (event) {
        // il parametro event consente di capire quale dei libri si vuole cancellare
        conf = confirm("Sei sicuro di voler eliminare questo libri?"); // finestra di conferma per la cancellazione di un libro
        if (conf) { // se l'utente conferma, si esegue la chiamata ajax per il servizio delete
            $.ajax({
                url: "http://localhost/bibliotecauniversitaria/rest/delete.php?isbn=" + event.target.value, // URL REST di cancellazione
                type: "DELETE", // specifica il tipo di richiesta
                contentType: 'application/json', // specifica il tipo di contenuto passato
                success: function (response) {
                    alert("Libro rimosso correttamente!");
                    on_read(); // dopo aver eliminato il libro, viene riletta la lista dei libri presenti
                },
                error: function (xhr, err, exc) {
                    // in caso di errore, viene mostrato sulla console
                    console.log(xhr, err, exc);
                }
            });
            return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
        }
    }

    // funzione di ricerca dei libri
    $("#search-form").on("submit", function () { // al submit della barra di ricerca...
        var s_search = $("#search-form").find("input[name='search']").val(); // prendo la keyowrd inserita dall'utente nell'input 
        $.ajax({
            url: "http://localhost/bibliotecauniversitaria/rest/search.php?s=" + s_search, // URL REST di ricerca
            type: "GET", // specifica il tipo di richiesta
            success: function (response) { // response = lista di libri (array di oggetti JSON)
                // crea header tabella
                html_table = "<table id='center'><tr><th>ISBN</th><th>Titolo</th><th>Autore</th><th>Editore</th><th>Giacenza</th></tr>";
                // se la response restituisce qualche libro
                if (response.libri.length > 0) { 
                    for (i = 0; i < response.libri.length; i++) {
                        titolo = response.libri[i].titolo;
                        autore = response.libri[i].autore;
                        editore = response.libri[i].editore;
                        id_delete = response.libri[i].isbn;
                        // accoda i record nella tabella
                        html_table += "<tr><td>" + titolo + "</td><td> " + autore + "</td><td> " + editore + "</td><td><input type='image' class='delete-button' src='images/cestino.png' value='" + id_delete + "'></td></tr>";
                    }
                } else {
                    html_table += "<tr><td colspan='4'>Nessun risultato per " + s_search + "</td></tr>";
                }
                html_table += "</table>";
                // inserisco la tabella nel div #libri
                $("#libri").html(html_table); 
                // all'on click del cestino parte la funzione on_delete()
                $(".delete-button").on("click", on_delete); 
                // all'on submit dell pulsante #read-all parte la funzione on_read()
                $("#read-all").on("submit", on_read); 
            },
            error: function (xhr, err, exc) {
                // in caso di errore, viene mostrato sulla console
                console.log(xhr, err, exc);
            }
        });
        return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
    });

    // funzione di inserimento di un libro
    on_create = function () {
        var formData = {}; // inizializzo un oggetto
        for (var form of $("#crealibri").serializeArray()) { // ciclo for per creare il body per la POST seguente a partire dai valori presenti nel form
            // il metodo serializeArray() crea un array di oggetti JavaScript, pronto per essere codificato come stringa JSON
            formData[form['name']] = form['value'];
        }
        $.ajax({
            url: "http://localhost/bibliotecauniversitaria/rest/create.php", // URL REST di inserimento
            type: "POST", // specifica il tipo di richiesta
            contentType: 'application/json', // // specifica il tipo di contenuto passato
            dataType: "json", 
            data: JSON.stringify(formData), // indica quali dati vengono passati
            success: function (response) {
                alert("Libro inserito correttamente!");
                on_read(); // dopo aver eliminato il libro, viene riletta la lista dei libri presenti
            },
            error: function (xhr, err, exc) {
                // in caso di errore, viene mostrato sulla console
                console.log(xhr, err, exc);
            }
        });
        return false; // necessario per far funzionare l'on click (senza parte la request legata all'attributo href)
    }

    on_read(); // all'apertura della pagina, parte la funzione on_read()
    $("#crealibri").on("submit", on_create); // all'on submit del form #crealibri parte la funzione on_create()
});