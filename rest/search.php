<?php
//stabilisco i permessi di lettura del file (anyone)
header("Access-Control-Allow-Origin: *");
// definisco il formato della risposta (json)
header("Content-Type: application/json; charset=UTF-8");

// includo le classi per la gestione dei dati
include_once $_SERVER["DOCUMENT_ROOT"].'/bibliotecauniversitaria/classes/Database.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/bibliotecauniversitaria/classes/Libro.php';

// creo una connessione al DBMS
$database = new Database();
$db = $database->getConnection();

// creo un'istanza di Evento
$libro = new Libro($db);

// leggo la keyword (s) nella richiesta (GET) 
// se $_GET['s'] è settata, la leggo, altrimenti a $keywords assegno una stringa vuota
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// invoco il metodo search() con parametro $keywords che restituisce la lista dei eventi. $stmt è un recordset
$stmt = $libro->search($keywords);

if ($stmt->rowCount() >= 0) { // se ci sono degli eventi
    // creo una coppia eventi: [libri_list]
    $libri_list = array();
    $libri_list["libri"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // la funzione fetch con parametro PDO::FETCH_ASSOC,
        // restituisce un record ($row), cioè un array le cui chiavi sono i nomi delle colonne della tabella
        // costruisco un array associativo che rappresenta ogni singolo evento
        $libro_item = array(
            "isbn" => $row['isbn'],
            "titolo" => $row['titolo'],
            "autore" => ($row['autore']),
            "editore" => $row['editore'],
            "giacenza" => $row['giacenza']
        );
        // inserisco l'evento ($libro_item) alla fine della lista dei libri ($libri_list["libro"])
        array_push($libri_list["libri"], $libro_item);
    }

    http_response_code(200); //  leggo tutti gli eventi
    // trasformo la coppia evento: $libri_list in un oggetto JSON e lo invio in HTTP response
    echo json_encode($libri_list);
} else { // se non ci sono eventi
    http_response_code(404); // Not found
    // creo un oggetto JSON costituito dalla coppia message -> testo del messaggio
    echo json_encode(array("message" => "Nessun libro trovato per " . $keywords));
}
