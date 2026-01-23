<?php
$conn = new mysqli("localhost", "root", "", "gestionestudenti");


if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];

$sql = "INSERT INTO studenti (nome, cognome) VALUES (?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $nome, $cognome);

if ($stmt->execute()) {
    echo "Studente inserito con successo! ID generato: " . $stmt->insert_id;
} else {
    echo "Errore durante l'inserimento: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>