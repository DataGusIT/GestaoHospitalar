<?php
include('../DAO/conexao.php');
include('../DAO/protect.php');

$idpacientes = $_SESSION['idpacientes'];

// Consulta ao banco de dados para obter as consultas do paciente
$query_consultas = "SELECT nome, tipo_agendamento, data_agendamento, hora_agendamento, id_agendamento
                    FROM pacientes 
                    LEFT JOIN agendamento ON pacientes.idpacientes = agendamento.id_paciente_agendamento
                    WHERE agendamento.id_paciente_agendamento = '$idpacientes'
                    ORDER BY data_agendamento DESC";

$resultado = mysqli_query($mysqli, $query_consultas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Histórico de Consultas</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            list-style: none;
            text-decoration: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .recuo {
            margin-top: 0px;
            background-color: #003366;
            /* Azul escuro */
        }

        .navegacao {
            background-color: #003366;
            /* Azul escuro */
            color: #fff;
            /* Texto branco para contraste */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 40px;
            box-shadow: 0 0.1rem 0.5rem #ccc;
            width: 100%;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .navegacao h1 {
            font-size: 18px;
            color: #fff;
            /* Texto branco para contraste */
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
            list-style-type: none;
        }

        .nav-menu li a {
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            padding: 5px 0;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: rgb(255, 255, 255);
            /* Linha clara ao passar o mouse */
            visibility: hidden;
            transition: width 0.3s ease;
        }

        .nav-menu li a:hover::after {
            width: 100%;
            visibility: visible;
        }

        .historico {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .historico h4 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 20px;
            color: #003366;
            /* Azul escuro */
        }

        #listar-Pacientes {
            margin-top: 20px;
        }

        #listar-Pacientes table {
            width: 100%;
            border-collapse: collapse;
        }

        #listar-Pacientes th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            background-color: #003366;
            /* Azul escuro */
            color: #fff;
            /* Branco para contraste */
        }

        #listar-Pacientes td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #listar-Pacientes tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #listar-Pacientes tr:hover {
            background-color: #f2f2f2;
        }

        .btn-excluir {
            color: #fff;
            background-color: rgb(255, 255, 255);
            /* Vermelho */
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .btn-excluir img {
            width: 20px;
            height: 20px;
        }

        .btn-excluir:hover {
            background-color: rgb(255, 255, 255);
            /* Vermelho mais escuro */
        }
    </style>
</head>

<body>

    <header>
        <div class="recuo"></div>

        <nav class="navegacao">
            <img src="../componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">
            <h1>Bem-vindo ao portal do paciente, <?php echo $_SESSION['nome']; ?>.</h1>
            <ul class="nav-menu">
                <li><a href="../index.html">Nosso Hospital</a></li>
                <li><a href="portalPaciente.php">Portal do Paciente</a></li>
                <li><a href="../DAO/logout.php">Sair da Conta</a></li>
            </ul>
        </nav>
    </header>

    <div class="historico">
        <h4>Histórico de Consultas</h4>
        <span id="msgAlerta"></span>

        <div id="listar-Pacientes">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo de Agendamento</th>
                        <th>Data do Agendamento</th>
                        <th>Hora do Agendamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($consulta = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($consulta['nome'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($consulta['tipo_agendamento'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($consulta['data_agendamento'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($consulta['hora_agendamento'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>
                                <a href='excluir_agendamento.php?id_agendamento={$consulta['id_agendamento']}' class='btn-excluir' onclick='return confirm(\"Tem certeza de que deseja excluir este agendamento?\")'>
                                    <img src='../componentes/imagens/delete.jpg' alt='Excluir'>
                                </a>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhuma consulta encontrada.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>