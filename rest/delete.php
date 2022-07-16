<?php
// accesso da chiunque, in formato JSON codice UTF-8, con richieste a metodo DELETE
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");

// includo le classi per la gestione dei dati
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Database.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Libro.php';

// creo una connessione al DBMS 
$database = new Database();
$db = $database->getConnection();

// creo un'istanza di Libro
$libro = new Libro($db);

// leggo l'id nella richiesta e lo inserisco nella variabile d'istanza id dell'oggetto $libro 
// se $_GET['id'] è settata, la leggo, altrimenti invoco il metodo die()
$libro->isbn = isset($_GET['isbn']) ? $_GET['isbn'] : die();

// invoco il metodo delete() che cancella l'evento indicato
$stmt = $libro->delete();
if ($stmt->rowCount() > 0) { // se trova l'elemento (è presente qualche record)
    http_response_code(200); // la risposta è ok (200 = OK)
    echo json_encode(array("message" => "Libro cancellato")); // e viene mandato indietro un messaggio JSON
} else { // se la cancellazione fallisce
    http_response_code(503); // la risposta è errore (503 = Service unavailable)
    echo json_encode(array("message" => "Libro non cancellato")); // e viene mandato indietro un messaggio JSON
}
