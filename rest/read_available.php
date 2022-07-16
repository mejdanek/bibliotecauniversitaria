<?php
// accesso da chiunque, in formato JSON codice UTF-8, con richieste a metodo GET
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

// includo le classi per la gestione dei dati
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Database.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Libro.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();

// creo un'istanza di Libro
$libro = new Libro($db);

// invoco il metodo read() che restituisce l'elenco dei libri
$stmt = $libro->read_available();

// lista di libri da riempire
$libri_list = array();
$libri_list['libri'] = array();

if ($stmt->rowCount() > 0) { // se vengono trovati libri nel database
    while ($riga = $stmt->fetch(PDO::FETCH_ASSOC)) { // scorri le righe della lista fino a quando trovi elementi 
        $libro_item = array(
            "isbn" => $riga['isbn'],
            "titolo" => $riga['titolo'],
            "autore" => ($riga['autore']),
            "editore" => $riga['editore'],
            "giacenza" => $riga['giacenza']
        );
        array_push($libri_list['libri'], $libro_item); // aggiungi questa riga nella lista di tutti i libri
    }
    echo json_encode($libri_list); // mostra la lista dei libri in formato JSON
} else { // se non ci sono libri
    http_response_code(404); // la risposta è errore (404 = Not Found)
    echo json_encode(array("message" => "Nessun libro trovato")); // e viene mandato indietro un messaggio JSON
}