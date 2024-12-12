<?php
session_start();
include_once('../DAO/conexao.php');

$idusuario = $_SESSION['idusuario'];

// Consulta ao banco de dados para obter as consultas do paciente
$query_consultas = "SELECT agendamento.id_agendamento, pacientes.idpacientes, pacientes.nome, agendamento.tipo_agendamento, agendamento.data_agendamento, agendamento.hora_agendamento 
                    FROM pacientes 
                    LEFT JOIN agendamento ON pacientes.idpacientes = agendamento.id_paciente_agendamento
                    WHERE agendamento.tipo_agendamento IS NOT NULL
                    ORDER BY agendamento.data_agendamento DESC";

$stmt = $mysqli->prepare($query_consultas);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Historico de Consultas</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            list-style: none;
            text-decoration: none;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            /* Cor de fundo neutra */
        }

        .navegacao {
            background-color: #00274D;
            /* Azul escuro */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            box-shadow: 0 0.1rem 0.5rem #ccc;
            width: 100%;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .navegacao h1 {
            font-size: 18px;
            color: white;
            /* Cor do texto branco */
        }

        .nav-menu {
            display: flex;
            justify-content: center;
            gap: 5rem;
            list-style-type: none;
        }

        .nav-menu li a {
            color: white;
            /* Texto branco */
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.5s;
            position: relative;
        }

        .nav-menu li a:hover {
            color: #FFD700;
            /* Dourado ao passar o mouse */
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -3px;
            left: 0;
            background-color: #FFD700;
            /* Linha dourada */
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out;
        }

        .nav-menu li a:hover::after {
            visibility: visible;
            transform: scaleX(1);
        }

        .historico {
            margin: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .historico h4 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
            color: #00274D;
            /* Azul escuro */
        }

        #listar-Pacientes {
            margin-top: 20px;
        }

        #listar-Pacientes table {
            width: 100%;
            border-collapse: collapse;
        }

        #listar-Pacientes th,
        #listar-Pacientes td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        #listar-Pacientes th {
            background-color: #00274D;
            /* Azul escuro */
            color: white;
            /* Texto branco */
        }

        #listar-Pacientes tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #listar-Pacientes tr:hover {
            background-color: #f2f2f2;
        }

        .action-icons {
            display: flex;
            justify-content: space-around;
        }

        .action-icons img {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navegacao">
            <img src="../componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">
            <ul class="nav-menu">
                <li><a href="portalAdmin.php">Portal Administrativo</a></li>
                <li><a href="../DAO/logout_admin.php">Sair da Conta</a></li>
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
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo de Agendamento</th>
                        <th>Data do Agendamento</th>
                        <th>Hora do Agendamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($stmt) {
                        $stmt->execute();
                        $stmt->store_result();

                        if ($stmt->num_rows > 0) {
                            $stmt->bind_result($id_agendamento, $idpacientes, $nome, $tipo_agendamento, $data_agendamento, $hora_agendamento);

                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($idpacientes) . "</td>";
                                echo "<td>" . htmlspecialchars($nome) . "</td>";
                                echo "<td>" . htmlspecialchars($tipo_agendamento) . "</td>";
                                echo "<td>" . htmlspecialchars($data_agendamento) . "</td>";
                                echo "<td>" . htmlspecialchars($hora_agendamento) . "</td>";
                                echo "<td class='action-icons'>
                                        <a href='./includeAdm/editar_agendamento.php?id=$id_agendamento'>
                                            <img src='../componentes/imagens/edit1.png' alt='Editar'>
                                        </a>
                                        <a href='./includeAdm/excluir_agendamento.php?id_agendamento=$id_agendamento' onclick='return confirm(\"Tem certeza de que deseja excluir este agendamento?\")'>
                                            <img src='../componentes/imagens/delete.jpg' alt='Excluir'>
                                        </a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Nenhuma consulta encontrada.</td></tr>";
                        }

                        $stmt->close();
                    } else {
                        echo "<tr><td colspan='6'>Erro na preparação da consulta.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>