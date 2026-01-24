<?php
$conn = new mysqli("localhost", "root", "", "gestionestudenti");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Nome = $_POST['nome'] ?? '';
    $Cognome = $_POST['cognome'] ?? '';

    $sql = "INSERT INTO studenti (nome, cognome) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ss", $Nome, $Cognome);
        if ($stmt->execute()) {
            $message = "Studente inserito con successo! ID generato: " . $stmt->insert_id;
        } else {
            $message = "Errore durante l'inserimento: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Errore nella preparazione della query: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Inserimento Studente</title>
    <link rel="stylesheet" href="../css/stileinserisci.css">
</head>

<body>
    <h1>Inserisci Studente</h1>

    <?php if ($message): ?>
        <p style="text-align:center; color:green; font-weight:bold"><?php echo $message; ?></p>
        <p style="text-align:center;"><a href="../index.html">Torna alla home</a></p>
    <?php endif; ?>

    <form method="post" action="inserisci.php">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="cognome">Cognome</label>
        <input type="text" id="cognome" name="cognome" required>

        <input type="submit" value="Inserisci">
    </form>

</body>

</html>