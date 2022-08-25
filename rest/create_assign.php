<?php
// accesso da chiunque, in formato JSON codice UTF-8, con richieste a metodo POST
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// includo le classi per la gestione dei dati
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Database.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Assegnazione.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();

// creo un'istanza di libro
$ass = new Assegnazione($db);

// leggo i dati nel body della request (metodo POST)
$data = json_decode(file_get_contents('php://input'));

// controllo che i dati ci siano
if (!empty($data->matricola) && !empty($data->isbn)) {
    $ass->isbn = $data->isbn;
    $ass->matricola = $data->matricola;
    // invoco il metodo create() che crea un nuovo libro
    if ($ass->create()) { // se l'inserimento va a buon fine
        http_response_code(201); // la risposta è ok (201 = Created)
        echo json_encode(array("message" => "Libro creato")); // e viene mandato indietro un messaggio JSON
    } else { // se l'inserimento fallisce
        http_response_code(503); // la risposta è errore (503 = Service unavailable)
        echo json_encode(array("message" => "Libro non creato")); // e viene mandato indietro un messaggio JSON
    }
} else { // se i dati sono incompleti
    http_response_code(400); // la risposta è errore (400 = Bad request)
    echo json_encode( // e viene mandato indietro un messaggio JSON
        array("message" => "Libro non creato. Dati incompleti: "
        . "matricola=" . $data->matricola . " isbn=" . $data->isbn)
    );
}
