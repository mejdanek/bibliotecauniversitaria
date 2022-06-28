<?php
class Evento
{
	// variabili d'istanza (proprietà degli eventi)
	private $conn;
	public $id;
	public $nome;
	public $tipo;
	public $citta;

	// construttore che inizializza la variabile $conn per la connessione
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// servizio di lettura
	function read()
	{
		// seleziono tutti gli eventi ordinandoli per il nome in ordine alfabetico
		$query = "SELECT * FROM eventi ORDER BY eventi.nome ASC";
		// preparo la query
		$stmt = $this->conn->prepare($query);
		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)
		return $stmt;
	}


	// servizio di creazione
	function create()
	{
		// inserisco il nuovo evento
		$query = "INSERT INTO eventi SET
				  nome=:nome, tipo=:tipo, citta=:citta";
		// preparo la query
		$stmt = $this->conn->prepare($query);

		// sanifico
		$this->nome = htmlspecialchars(strip_tags($this->nome));
		$this->tipo = htmlspecialchars(strip_tags($this->tipo));
		$this->citta = htmlspecialchars(strip_tags($this->citta));

		// invio i valori del nuovo evento per i parametri
		$stmt->bindParam(":nome", $this->nome);
		$stmt->bindParam(":tipo", $this->tipo);
		$stmt->bindParam(":citta", $this->citta);

		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)

		return $stmt;
	}


	// servizio di cancellazione
	function delete()
	{
		// cancello l'evento con l'id indicato
		$query = "DELETE FROM eventi WHERE id = ?";
		// preparo la query
		$stmt = $this->conn->prepare($query);
		// sanifico
		$this->id = htmlspecialchars(strip_tags($this->id));
		// invio il valore dell'evento per il parametro
		$stmt->bindParam(1, $this->id);
		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)
		return $stmt;
	}

	// servizio di ricerca per keywords
	function search($keywords)
	{
		// cerco gli eventi ordinandoli per il nome in ordine alfabetico
		$query = "SELECT * FROM eventi
				  WHERE eventi.nome LIKE ? OR eventi.tipo LIKE ? OR eventi.citta LIKE ?
				  ORDER BY eventi.nome ASC";

		// preparo la query
		$stmt = $this->conn->prepare($query);
		// sanifico
		$keywords = htmlspecialchars(strip_tags($keywords));
		// % prima e dopo le keywords serve per estrarre i testi che contiene la keyword
		$keywords = "%{$keywords}%";

		// invio i valori degli eventi per i parametri
		$stmt->bindParam(1, $keywords);
		$stmt->bindParam(2, $keywords);
		$stmt->bindParam(3, $keywords);

		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)

		return $stmt;
	}
}
