<?php
// accesso da chiunque, in formato JSON codice UTF-8, con richieste a metodo POST
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

// includo le classi per la gestione dei dati
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Database.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Assegnazione.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();

// creo un'istanza di libro
$ass = new Assegnazione($db);

// leggo l'id nella richiesta e lo inserisco nella variabile d'istanza id dell'oggetto $ass 
// se $_GET['id'] è settata, la leggo, altrimenti invoco il metodo die()
$ass->isbn = isset($_GET['isbn']) ? $_GET['isbn'] : die();
$ass->matricola = isset($_GET['matricola']) ? $_GET['matricola'] : die();

// invoco il metodo create() che aggiunge la prenotazione
$stmt = $ass->create();
if ($stmt->rowCount() > 0) { // se trova l'elemento (è presente qualche record)
    http_response_code(200); // la risposta è ok (200 = OK)
    echo json_encode(array("message" => "Libro prenotato")); // e viene mandato indietro un messaggio JSON
} else { // se la cancellazione fallisce
    http_response_code(503); // la risposta è errore (503 = Service unavailable)
    echo json_encode(array("message" => "Libro non prenotato")); // e viene mandato indietro un messaggio JSON
}
