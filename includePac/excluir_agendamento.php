<?php
    include('../DAO/conexao.php');
    include('../DAO/protect.php');

$id_agendamento = $_GET['id_agendamento'];

$query_excluir = "DELETE FROM agendamento WHERE id_agendamento = '{$id_agendamento}'";

$resultado = mysqli_query($mysqli, $query_excluir);

if($resultado){
    echo "Agendamento excluído com sucesso!";
    header("Location: historico.php");
} else {
    echo "Erro ao excluir o agendamento: ";
}
?>
