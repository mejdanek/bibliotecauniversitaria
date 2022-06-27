<?php
include_once 'db-connect-db-close.php'; // include la pagina di connessione e di chiusura al db
$conn = db_connect(); // connessione al db
$S = "INSERT INTO admin(username, password)
VALUES ('Alessia', 'admin95')"; // inserisco nella tabella admin nelle colonne username e password i valori indicati
$inserisci = mysqli_query($conn, $S); // // eseguo la query
db_close($conn);
