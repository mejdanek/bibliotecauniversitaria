<?php
// accesso da chiunque, in formato JSON codice UTF-8, con richieste a metodo POST
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// includo le classi per la gestione dei dati
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Database.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/bibliotecauniversitaria/classes/Libro.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();

// creo un'istanza di libro
$libro = new Libro($db);

// leggo i dati nel body della request (metodo POST)
$data = json_decode(file_get_contents('php://input'));

// controllo che i dati ci siano
if (!empty($data->titolo) && !empty($data->autore) && !empty($data->editore) && !empty($data->isbn) && !empty($data->giacenza)) {
    // inserisco i valori nelle variabili d'istanza dell'oggetto $libro
    $libro->titolo = $data->titolo;
    $libro->autore = $data->autore;
    $libro->editore = $data->editore;
    $libro->isbn = $data->isbn;
    $libro->giacenza = $data->giacenza;
    // invoco il metodo create() che crea un nuovo libro
    if ($libro->create()) { // se l'inserimento va a buon fine
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
        . "titolo=" . $data->titolo . " autore=" . $data->autore . " editore=" . $data->editore . " isbn=" . $data->isbn . " giacenza=" . $data->giacenza)
    );
}
