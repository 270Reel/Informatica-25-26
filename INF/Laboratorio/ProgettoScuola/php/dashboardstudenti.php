<?php
$conn = new mysqli("localhost", "root", "", "gestionestudenti");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "SELECT s.nome, s.cognome, AVG(v.voto) AS media_voti, 
               MIN(v.voto) AS voto_minimo, 
               MAX(v.voto) AS voto_massimo
        FROM studenti s 
        JOIN voti v ON s.matricola = v.matricola
        GROUP BY s.matricola";

$result = $conn->query($sql);

echo '<!DOCTYPE html>';
echo '<html lang="it">';
echo '<head>
<meta charset="utf-8">
<title>Dashboard Studenti</title>

<style>
:root{
    --bg:#f4f7fb;
    --card:#ffffff;
    --primary:#2e9e60;
    --accent:#0ea5a9;
    --muted:#6b7280;
    --radius:12px;
}

*{box-sizing:border-box}

body{
    margin:0;
    font-family: Inter, system-ui, -apple-system, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    background: linear-gradient(180deg,var(--bg),#eef3f8);
    color:#0f1724;
    -webkit-font-smoothing:antialiased;
}

.form-wrap{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:28px 12px;
}

.card{
    width:100%;
    max-width:900px;
    background:var(--card);
    padding:28px;
    border-radius:var(--radius);
    box-shadow:0 12px 30px rgba(15,23,42,0.06);
}

h2{
    text-align:center;
    color:#102a43;
    margin-bottom:20px;
}

.table-responsive{
    overflow:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    margin:18px 0;
}

th,td{
    padding:12px;
    text-align:left;
    border-bottom:1px solid #eef3f6;
}

th{
    background:linear-gradient(90deg,var(--primary),#1f8a4f);
    color:#fff;
    font-weight:700;
}

tr:nth-child(odd){
    background:#fbfeff;
}

.msg{
    padding:12px;
    border-radius:8px;
    margin:12px 0;
    text-align:center;
}

.msg.error{
    background:#fff5f5;
    color:#7f1d1d;
    border:1px solid rgba(127,29,29,0.08);
}

@media (max-width:520px){
    .card{padding:16px;border-radius:10px}
}
</style>

</head>';

echo '<body>';
echo '<div class="form-wrap">';
echo '<div class="card">';
echo '<h2>Dashboard Studenti</h2>';

if ($result && $result->num_rows > 0) {

    echo '<div class="table-responsive">';
    echo "<table>";
    echo "<tr>
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
    echo "</div>";

} else {
    echo "<div class='msg error'>Nessun risultato trovato.</div>";
}

echo '</div>';
echo '</div>';
echo '</body></html>';

$conn->close();
?>
