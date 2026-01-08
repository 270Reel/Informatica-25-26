<?php
$conn = new mysqli("localhost", "root", "", "gestionestudenti");

if ($conn->connect_error) {
    die("Connessione fallita");
}

if (isset($_POST['salva'])) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    
    $sql = "INSERT INTO studenti (nome, cognome)
            VALUES ('$nome', '$cognome')";
    $conn->query($sql);
    echo "Studente inserito con successo!";
}
?>

<h2>Inserimento Studente</h2>

<form method="post">
    Nome: <input type="text" name="nome" required><br><br>
    Cognome: <input type="text" name="cognome" required><br><br
    <input type="submit" name="salva" value="Inserisci">
</form>

<br>
<a href="index.html">Torna al menu</a>
