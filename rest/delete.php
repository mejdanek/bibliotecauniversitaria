<?php
//stabilisco i permessi di lettura del file (anyone)
header("Access-Control-Allow-Origin: *");
// definisco il formato della risposta (json)
header("Content-Type: application/json; charset=UTF-8");
// definisco il metodo consentito per la request
header("Access-Control-Allow-Methods: DELETE");

// includo le classi per la gestione dei dati
include_once '../classes/Database.php';
include_once '../classes/Evento.php';

// creo una connessione al DBMS 
$database = new Database();
$db = $database->getConnection();

// creo un'istanza di Evento
$evento = new Evento($db);

// leggo l'id nella richiesta e lo inserisco nella variabile d'istanza id dell'oggetto $evento 
// se $_GET['id'] è settata, la leggo, altrimenti invoco il metodo die()
$evento->id = isset($_GET['id']) ? $_GET['id'] : die();

// invoco il metodo delete() che cancella l'evento indicato
// $stmt è un recordset
$stmt = $evento->delete();
if ($stmt->rowCount() > 0) { // se va tutto bene
    http_response_code(200); //  eliminato
    // creo un oggetto JSON costituito dalla coppia message -> testo del messaggio
    echo json_encode(array("message" => "Evento cancellato"));
} else { // se la delete fallisce
    http_response_code(503); // servizio non disponibile
    echo json_encode(array("message" => "Evento non cancellato"));
}
