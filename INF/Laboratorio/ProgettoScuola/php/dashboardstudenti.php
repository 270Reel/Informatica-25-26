<?php
$conn = new mysqli("localhost", "root", "", "gestionestudenti");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "SELECT s.nome, s.cognome, AVG(v.voto) AS media_voti, MIN(v.voto) AS voto_minimo, MAX(v.voto) AS voto_massimo
FROM studenti s JOIN voti v
ON s.matricola = v.matricola
GROUP BY s.matricola";

$result = $conn->query($sql);

echo '<!DOCTYPE html>';
echo '<html lang="it">';
echo '<head><meta charset="utf-8"><title>Dashboard Studenti</title><link rel="stylesheet" href="../css/stileinserisci.css"></head>';
echo '<body>';

if ($result && $result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0' style='margin:20px auto; border-collapse:collapse;'>";
    echo "<tr style='background-color:#8e44ad; color:white;'>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Media voti</th>
            <th>Voto max</th>
            <th>Voto min</th>
          </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["nome"]) . "</td>
                <td>" . htmlspecialchars($row["cognome"]) . "</td>
                <td>" . number_format($row["media_voti"], 2) . "</td>
                <td>" . $row["voto_massimo"] . "</td>
                <td>" . $row["voto_minimo"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='text-align:center; color:red;'>Nessun risultato trovato.</p>";
}

echo '</body></html>';

$conn->close();
?>