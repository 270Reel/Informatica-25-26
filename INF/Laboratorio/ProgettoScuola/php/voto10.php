<?php
// ==========================
// CONNESSIONE DATABASE
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
// QUERY STUDENTI CON VOTO 10
// ==========================
$sql = "SELECT s.nome, s.cognome, v.voto
        FROM studenti s
        JOIN voti v ON s.matricola = v.matricola
        WHERE v.voto = 10";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studenti con voto 10</title>
    <link rel="stylesheet" href="css/stilevoto10.css">
</head>

<body>

<div class="form-wrap">
    <div class="card">

        <h2>Studenti con voto 10</h2>

        <?php if ($result && $result->num_rows > 0): ?>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Voto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nome']); ?></td>
                                <td><?php echo htmlspecialchars($row['cognome']); ?></td>
                                <td><?php echo htmlspecialchars($row['voto']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <div class="msg error">
                Nessun risultato trovato.
            </div>
        <?php endif; ?>

    </div>
</div>

</body>
</html>
