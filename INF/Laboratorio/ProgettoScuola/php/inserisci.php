<?php
// ==========================
// CONNESSIONE AL DATABASE
// ==========================
$host = "localhost";
$user = "root";
$password = "";
$database = "gestionestudenti";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// ==========================
// LOGICA INSERIMENTO
// ==========================
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $cognome = trim($_POST['cognome'] ?? '');

    if (!empty($nome) && !empty($cognome)) {

        $sql = "INSERT INTO studenti (nome, cognome) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $nome, $cognome);

            if ($stmt->execute()) {
                $message = "Studente inserito con successo! ID: " . $stmt->insert_id;
                $messageType = "success";
            } else {
                $message = "Errore durante l'inserimento.";
                $messageType = "error";
            }

            $stmt->close();
        } else {
            $message = "Errore nella preparazione della query.";
            $messageType = "error";
        }

    } else {
        $message = "Compila tutti i campi.";
        $messageType = "error";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Studente</title>
    <link rel="stylesheet" href="css/stileinserisci.css">
</head>

<body>

<div class="form-wrap">
    <form method="post">

        <h2>Inserisci Studente</h2>

        <?php if (!empty($message)): ?>
            <div class="msg <?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="cognome">Cognome</label>
        <input type="text" id="cognome" name="cognome" required>

        <input type="submit" value="Inserisci">

        <p class="home-link">
            <a href="index.html">Torna alla home</a>
        </p>

    </form>
</div>

</body>
</html>