<?php
class Libro
{
	// variabili d'istanza Libro
	private $conn;
	public $isbn;
	public $titolo;
	public $autore;
	public $editore;
    public $giacenza;

	// costruttore per la connessione al database
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// servizio di lettura
	function read()
	{
		// seleziono tutti gli eventi ordinandoli per il nome in ordine alfabetico
		$query = "SELECT * FROM libri ORDER BY libri.autore ASC";
		// preparo la query
		$stmt = $this->conn->prepare($query);
		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)
		return $stmt;
	}

	function read_available()
	{
		// seleziono tutti gli eventi ordinandoli per il nome in ordine alfabetico
		$query = "SELECT * FROM libri WHERE giacenza > 0 ORDER BY libri.autore ASC";
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
		$query = "INSERT INTO libri SET
				  titolo=:titolo, autore=:autore, editore=:editore, isbn=:isbn, giacenza=:giacenza";
		// preparo la query
		$stmt = $this->conn->prepare($query);

		// rimuovo caratteri speciali eventualmente inseriti nel form
		$this->titolo = htmlspecialchars(strip_tags($this->titolo));
		$this->autore = htmlspecialchars(strip_tags($this->autore));
		$this->editore = htmlspecialchars(strip_tags($this->editore));
		$this->isbn = htmlspecialchars(strip_tags($this->isbn));
		$this->giacenza = htmlspecialchars(strip_tags($this->giacenza));

		// invio i valori del nuovo libro per i parametri
		$stmt->bindParam(":titolo", $this->titolo);
		$stmt->bindParam(":autore", $this->autore);
		$stmt->bindParam(":editore", $this->editore);
        $stmt->bindParam(":isbn", $this->isbn);
		$stmt->bindParam(":giacenza", $this->giacenza);

		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)

		return $stmt;
	}

	// servizio di cancellazione
	function delete()
	{
		// cancello il libro con l'isbn indicato
		$query = "DELETE FROM libri WHERE isbn = ?";
		// preparo la query
		$stmt = $this->conn->prepare($query);
		// sanifico
		$this->id = htmlspecialchars(strip_tags($this->isbn));
		// invio il valore del libro per il parametro
		$stmt->bindParam(1, $this->isbn);
		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)
		return $stmt;
	}

	// servizio di ricerca per keywords
	function search($keywords)
	{
		// cerco gli eventi ordinandoli per il nome in ordine alfabetico
		$query = "SELECT * FROM libri
				  WHERE libri.titolo LIKE ? OR libri.autore LIKE ? OR libri.editore LIKE ? OR libri.isbn LIKE ?
				  ORDER BY libri.titolo ASC";

		// preparo la query
		$stmt = $this->conn->prepare($query);
		// rimuovo caratteri speciali eventualmente inseriti nel form
		$keywords = htmlspecialchars(strip_tags($keywords));
		// % prima e dopo le keywords serve per estrarre i testi che contiene la keyword
		$keywords = "%{$keywords}%";

		// invio i valori degli eventi per i parametri
		$stmt->bindParam(1, $keywords);
		$stmt->bindParam(2, $keywords);
		$stmt->bindParam(3, $keywords);
		$stmt->bindParam(4, $keywords);

		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)

		return $stmt;
	}
}
