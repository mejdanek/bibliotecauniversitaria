<?php
header("Access-Control-Allow-Origin: *");                 // stabilisco i permessi di lettura del file (anyone)
header("Content-Type: application/json; charset=UTF-8");  // definisco il formato della risposta (json)

// includo le classi per la gestione dei dati
include_once $_SERVER["DOCUMENT_ROOT"].'/bibliotecauniversitaria/classes/Database.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/bibliotecauniversitaria/classes/Libro.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();

// creo un'istanza di Libro
$libro = new Libro($db);

// invoco il metodo read() che restituisce l'elenco dei libri. $stmt è un recordset
$stmt = $libro->read();

// lista di libri da riempire
$libri_list = array();

// se vengono trovati libri nel database
if ($stmt->rowCount() > 0) { 
    // scorri l'array fino a quando trovi righe 
    while ($riga = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $libro_item = array(
            "isbn" => $riga['isbn'],
            "titolo" => $riga['titolo'],
            "autore" => ($riga['autore']),
            "editore" => $riga['editore'],
            "giacenza" => $riga['giacenza']
        );
        // aggiungi questa riga nella lista di tutti i libri
        array_push($libri_list, $libro_item);
    }
    // mostra la lista dei libri
    echo json_encode($libri_list);

} else { // se non ci sono libri
    http_response_code(404); // Not found
    // creo un oggetto JSON costituito dalla coppia message -> testo del messaggio
    echo json_encode(array("message" => "Nessun libro trovato"));
}






    /*// se ci sono dei libri
    // creo una coppia eventi: [lista di eventi]
    $libri_list = array();
    $libri_list["evento"] = array();

    while ($riga = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // la funzione fetch con parametro PDO::FETCH_ASSOC,
        // restituisce un record ($riga), cioè un array le cui chiavi sono i nomi delle colonne della tabella
        // costruisco un array associativo che rappresenta ogni singolo evento
        $libro_item = array(
            "id" => $riga['id'],
            "nome" => $riga['nome'],
            "tipo" => ($riga['tipo']),
            "citta" => $riga['citta']
        );
        // inserisco l'evento ($libro_item) alla fine della lista degli eventi ($libri_list["evento"])
        array_push($libri_list["evento"], $libro_item);
    }

    http_response_code(200); //  leggo tutti gi eventi
    // trasformo la coppia evento: $libri_list in un oggetto JSON e lo invio in HTTP response
    echo json_encode($libri_list);*/