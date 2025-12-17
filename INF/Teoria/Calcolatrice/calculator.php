<?php
$num1 = $_POST['num1'] ?? 0;
$num2 = $_POST['num2'] ?? 0;
$operator = $_POST['operator'] ?? '';
$result = '';

switch($operator) {
    case "add":
        $result = $num1 + $num2;
        break;
    case "subtract":
        $result = $num1 - $num2;
        break;
    case "multiply":
        $result = $num1 * $num2;
        break;
    case "divide":
        $result = ($num2 != 0) ? $num1 / $num2 : "Errore: divisione per zero!";
        break;
    default:
        $result = "Operazione non valida";
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato Calcolatrice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator">
        <p>Risultato: <strong><?php echo $result; ?></strong></p>
        <a href="index.html">Torna alla calcolatrice</a>
    </div>
</body>
</html>
