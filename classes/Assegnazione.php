<?php
class Assegnazione
{
	// variabili d'istanza Assegnazione
	private $conn;
	public $isbn;
	public $matricola;

	// costruttore per la connessione al database
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// funzione privata per l'aggiornamento della giacenza
	private function update_qty($sign)
	{
		// cerca l'attuale giacenza del libro
		$query = "SELECT giacenza FROM libri WHERE isbn=:isbn";
		$stmt = $this->conn->prepare($query);

		// rimuovo caratteri speciali eventualmente inseriti nel form
		$this->isbn = htmlspecialchars(strip_tags($this->isbn));
		$this->matricola = htmlspecialchars(strip_tags($this->matricola));

		// assegna il valore della proprietà dell'oggetto all'interno della query SQL
        $stmt->bindParam(":isbn", $this->isbn);
		
		// esegue la query e memorizza l'attuale valore di giacenza
		$stmt->execute();
		$giacenza = $stmt->fetch()[0];

		// aggiorna il valore di giacenza in base al segno ($sign) passato
		$query = "UPDATE libri SET giacenza = ". $giacenza ." ". $sign ." 1 WHERE isbn=:isbn";
		$stmt = $this->conn->prepare($query);

		// rimuovo caratteri speciali eventualmente inseriti nel form
		$this->isbn = htmlspecialchars(strip_tags($this->isbn));
		$this->matricola = htmlspecialchars(strip_tags($this->matricola));

		// assegna il valore della proprietà dell'oggetto all'interno della query SQL
        $stmt->bindParam(":isbn", $this->isbn);
		
		// esegue la query di aggiornamento giacenza
		$stmt->execute();

	}

	// servizio di lettura
	function read()
	{
		// seleziono tutti gli eventi ordinandoli per il nome in ordine alfabetico
		$query = "SELECT * FROM assegnazioni";
		// preparo la query
		$stmt = $this->conn->prepare($query);
		// eseguo la query, $stmt conterrà il risultato dell'esecuzione della query (recordset)
		$stmt->execute();
		return $stmt;
	}

	// servizio di creazione
	function create()
	{
		// inserisco la prenotazione del libro
		$query = "INSERT INTO assegnazioni SET isbn=:isbn, matricola=:matricola";
		$stmt = $this->conn->prepare($query);

		// rimuovo caratteri speciali eventualmente inseriti nel form
		$this->isbn = htmlspecialchars(strip_tags($this->isbn));
		$this->matricola = htmlspecialchars(strip_tags($this->matricola));

		// assegna il valore della proprietà dell'oggetto all'interno della query SQL
        $stmt->bindParam(":isbn", $this->isbn);
		$stmt->bindParam(":matricola", $this->matricola);

		// eseguo la query, $stmt conterrà il risultato dell'esecuzione della query (recordset)
		$stmt->execute();

		// aggiorno la giacenza
		$this->update_qty("-");

		return $stmt;
	}

	// servizio di cancellazione
	function delete()
	{
		// rimuovo la prenotazione del libro
		$query = "DELETE FROM assegnazioni WHERE isbn = ? AND matricola = ?";
		$stmt = $this->conn->prepare($query);

		// rimuovo caratteri speciali eventualmente inseriti nel form
		$this->id = htmlspecialchars(strip_tags($this->isbn));

		// assegna il valore della proprietà dell'oggetto all'interno della query SQL
		$stmt->bindParam(1, $this->isbn);
		$stmt->bindParam(2, $this->matricola);

		// eseguo la query, $stmt conterrà il risultato dell'esecuzione della query (recordset)
		$stmt->execute();

		// aggiorno la giacenza
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
		$stmt = $this->conn->prepare($query);

		// rimuovo caratteri speciali eventualmente inseriti nel form
		$matricola = htmlspecialchars(strip_tags($matricola));

		// assegna il valore della proprietà dell'oggetto all'interno della query SQL
		$stmt->bindParam(1, $matricola);

		// eseguo la query, $stmt conterrà il risultato dell'esecuzione della query (recordset)
		$stmt->execute();

		return $stmt;
	}
}
