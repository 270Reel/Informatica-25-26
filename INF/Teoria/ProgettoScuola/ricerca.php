<?php
$conn = new mysqli("localhost", "root", "", "scuola");

if ($conn->connect_error) {
    die("Connessione fallita");
}
?>

<h2>Ricerca Studente per Cognome</h2>

<form method="post">
    Cognome: <input type="text" name="cognome">
    <input type="submit" name="cerca" value="Cerca">
</form>

<br>

<?php
if (isset($_POST['cerca'])) {
    $cognome = $_POST['cognome'];

    $sql = "SELECT * FROM studenti WHERE cognome LIKE '%$cognome%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Classe</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['cognome']}</td>
                    <td>{$row['classe']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Nessun risultato trovato";
    }
}
?>

<br>
<a href="index.html">Torna al menu</a>
