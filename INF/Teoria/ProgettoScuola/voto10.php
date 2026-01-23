<?php
$conn = new mysqli("localhost", "root", "", "gestionestudenti");


if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "SELECT s.nome, s.cognome
FROM studenti s JOIN voti v
ON s.matricola = v.matricola
WHERE v.voto = 10";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0' style='margin:20px auto; border-collapse:collapse;'>";
    echo "<tr style='background-color:#8e44ad; color:white;'>
            <th>Nome</th>
            <th>Cognome</th>
          </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nome"] . "</td>
                <td>" . $row["cognome"] . "</td>
                <td>" . $row["voti"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='text-align:center; color:red;'>Nessun risultato trovato.</p>";
}

$conn->close();
?>