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
// QUERY DASHBOARD
// ==========================
$sql = "SELECT s.nome, s.cognome, 
               AVG(v.voto) AS media_voti,
               MIN(v.voto) AS voto_minimo,
               MAX(v.voto) AS voto_massimo
        FROM studenti s
        JOIN voti v ON s.matricola = v.matricola
        GROUP BY s.matricola";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Studenti</title>
    <link rel="stylesheet" href="css/stiledashboard.css">
</head>

<body>

<div class="form-wrap">
    <div class="card">

        <h2>Dashboard Studenti</h2>

        <?php if ($result && $result->num_rows > 0): ?>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Media voti</th>
                            <th>Voto massimo</th>
                            <th>Voto minimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nome']); ?></td>
                                <td><?php echo htmlspecialchars($row['cognome']); ?></td>
                                <td><?php echo number_format($row['media_voti'], 2); ?></td>
                                <td><?php echo htmlspecialchars($row['voto_massimo']); ?></td>
                                <td><?php echo htmlspecialchars($row['voto_minimo']); ?></td>
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
