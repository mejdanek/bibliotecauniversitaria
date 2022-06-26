<?php
include_once("include/Database.php");

header("Content-Type:application/json");
$method = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->getConnection();

$response['method'] = $method;
switch($method){
    // Create if request method is POST
    case 'POST':
        $sql = "INSERT INTO utenti VALUES ('".$_GET['username']."','".$_GET['password']."','".$_GET['nome']."','".$_GET['cognome']."','".$_GET['genere']."',".$_GET['tipo'].",".$_GET['somma'].",'".$_GET['universita']."')";
        $response['query'] = $sql;
        $query = $conn->prepare($sql);
		$query->execute();
        break;
    // Read if request method is GET
    case 'GET':
        $sql = "SELECT * FROM utenti";
        $query = $conn->prepare($sql);
		$query->execute();
        $response['result'] = $query->fetchAll(PDO::FETCH_ASSOC);
        break;
	// Update if request method is PUT
    case 'PUT':
        $sql = "UPDATE utenti SET nome = '" . $_GET['nome'] . "' WHERE username='" . $_GET['username'] ."'";
        $response['query'] = $sql;
        $query = $conn->prepare($sql);
		$query->execute();
        break;
    // Delete if request method is DELETE
    case 'DELETE':
        $sql = "DELETE FROM utenti WHERE username='" . $_GET['username'] ."'";
        $response['query'] = $sql;
        $query = $conn->prepare($sql);
		$query->execute();
        break;
    case 'OPTIONS':
        $response['message'] = "available operations: GET, POST, PUT, DELETE";
}

$json_response = json_encode($response);
echo $json_response;
?>
