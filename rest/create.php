<?php
//stabilisco i permessi di lettura del file (anyone)
header("Access-Control-Allow-Origin: *");
// definisco il formato della risposta (json)
header("Content-Type: application/json; charset=UTF-8");
// definisco il metodo consentito per la request
header("Access-Control-Allow-Methods: POST");

// includo le classi per la gestione dei dati
include_once '../classes/Database.php';
include_once '../classes/Evento.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();

// creo un'istanza di Evento
$evento = new Evento($db);

// leggo i dati nel body della request (metodo POST)
$data = json_decode(file_get_contents("php://input"));

// controllo se i dati ci siano
if (
    !empty($data->nome) &&
    !empty($data->tipo) &&
    !empty($data->citta)
) {
    // inserisco i valori nelle variabili d'istanza dell'oggetto $evento
    $evento->nome = $data->nome;
    $evento->tipo = $data->tipo;
    $evento->citta = $data->citta;

    // invoco il metodo create() che crea un nuovo evento
    if ($evento->create()) { // se va tutto bene
        http_response_code(201); //  creato
        // creo un oggetto JSON costituito dalla coppia message -> testo del messaggio
        echo json_encode(array("message" => "Evento creato"));
    } else { // se la creazione fallisce
        http_response_code(503); //  servizio non disponibile
        echo json_encode(array("message" => "Evento non creato"));
    }
} else { // se i dati sono incompleti
    http_response_code(400); //  bad request
    echo json_encode(array("message" => "Evento non creato. Dati incompleti: "
        . "nome=" . $data->nome . " tipo=" . $data->tipo . " citta=" . $data->citta));
}
