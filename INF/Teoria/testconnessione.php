<?php

$conn = new mysqli("localhost", "root", "", "gestionestudenti");

if($conn->connect_error) {
    die("Connessione fallite: " . $conn->connect_error);
}

echo "Connessione riuscita!";

?>