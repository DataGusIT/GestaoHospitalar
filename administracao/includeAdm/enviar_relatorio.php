<?php

include('../../DAO/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPaciente = $_POST["id_paciente"];
    $relatorio = $_POST["relatorio"];

    $sql = "INSERT INTO relatorios (id_paciente_relatorio, relatorio) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $idPaciente, $relatorio);
    $stmt->execute();
    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Relatório</title>
</head>
<body>
    <h2>Adicionar Relatório</h2>
    <form method="post">
        <input type="hidden" name="id_paciente" value="1"> <!-- Substitua 1 pelo ID do paciente -->
        <textarea name="relatorio" rows="4" cols="50" placeholder="Digite o relatório aqui"></textarea><br>
        <input type="submit" value="Adicionar Relatório">
    </form>
</body>
</html>
