<?php
class Assegnazione
{
	// variabili d'istanza Libro
	private $conn;
	public $isbn;
	public $matricola;

	// costruttore per la connessione al database
	public function __construct($db)
	{
		$this->conn = $db;
	}

	private function update_qty($sign)
	{
		$query = "SELECT giacenza FROM libri WHERE isbn=:isbn";
		$stmt = $this->conn->prepare($query);

		// rimuovo caratteri speciali eventualmente inseriti nel form
		$this->isbn = htmlspecialchars(strip_tags($this->isbn));
		$this->matricola = htmlspecialchars(strip_tags($this->matricola));

        $stmt->bindParam(":isbn", $this->isbn);
		
		$stmt->execute();
		$giacenza = $stmt->fetch()[0];

		$query = "UPDATE libri SET giacenza = ". $giacenza ." ". $sign ." 1 WHERE isbn=:isbn";
		$stmt = $this->conn->prepare($query);

		// rimuovo caratteri speciali eventualmente inseriti nel form
		$this->isbn = htmlspecialchars(strip_tags($this->isbn));
		$this->matricola = htmlspecialchars(strip_tags($this->matricola));

        $stmt->bindParam(":isbn", $this->isbn);
		
		$stmt->execute();

	}

	// servizio di lettura
	function read()
	{
		// seleziono tutti gli eventi ordinandoli per il nome in ordine alfabetico
		$query = "SELECT * FROM assegnazioni";
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
		$query = "INSERT INTO assegnazioni SET isbn=:isbn, matricola=:matricola";
		// preparo la query
		$stmt = $this->conn->prepare($query);

		// rimuovo caratteri speciali eventualmente inseriti nel form
		$this->isbn = htmlspecialchars(strip_tags($this->isbn));
		$this->matricola = htmlspecialchars(strip_tags($this->matricola));

		// invio i valori del nuovo libro per i parametri
        $stmt->bindParam(":isbn", $this->isbn);
		$stmt->bindParam(":matricola", $this->matricola);

		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)

		$this->update_qty("-");

		return $stmt;
	}

	// servizio di cancellazione
	function delete()
	{
		// cancello il libro con l'isbn indicato
		$query = "DELETE FROM assegnazioni WHERE isbn = ? AND matricola = ?";
		
		// preparo la query
		$stmt = $this->conn->prepare($query);
		// sanifico
		$this->id = htmlspecialchars(strip_tags($this->isbn));
		// invio il valore del libro per il parametro
		$stmt->bindParam(1, $this->isbn);
		$stmt->bindParam(2, $this->matricola);
		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)

		$this->update_qty("+");

		return $stmt;
	}

	// servizio di ricerca pematricolar matricola
	function search($matricola)
	{
		// cerco gli eventi ordinandoli per il nome in ordine alfabetico
		$query = "SELECT libri.titolo,libri.autore,libri.editore,libri.isbn FROM libri
		LEFT JOIN assegnazioni ON libri.isbn = assegnazioni.isbn
		WHERE assegnazioni.matricola = ?";

		// preparo la query
		$stmt = $this->conn->prepare($query);
		// rimuovo caratteri speciali eventualmente inseriti nel form
		$matricola = htmlspecialchars(strip_tags($matricola));

		// invio i valori degli eventi per i parametri
		$stmt->bindParam(1, $matricola);

		// eseguo la query
		$stmt->execute(); // $stmt conterrà il risultato dell'esecuzione della query (recordset)

		return $stmt;
	}
}
