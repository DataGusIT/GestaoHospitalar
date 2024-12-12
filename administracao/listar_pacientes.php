<?php
session_start();
include_once('../DAO/conexao.php');

$idusuario = $_SESSION['idusuario'];

$query_consultas = "SELECT idpacientes, nome, cpf, email, telefone, sexo, data_nascimento, cep FROM pacientes";

$resultado = mysqli_query($mysqli, $query_consultas);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Morello - Pacientes</title>

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
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .navegacao {
            background-color: #003366;
            /* Azul escuro */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 40px;
            box-shadow: 0 0.2rem 0.5rem rgba(0, 0, 0, 0.2);
            width: 100%;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .navegacao h1 {
            font-size: 18px;
            color: white;
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
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
        }

        .historico h4 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 20px;
            color: #003366;
            /* Azul escuro para o título */
            ;
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
            /* Azul escuro para cabeçalhos da tabela */
            color: #fff;
            /* Branco para contraste com o fundo escuro */
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
            background-color: #f1f1f1;
        }

        .action-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .action-icons img {
            width: 20px;
            height: 20px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .action-icons img:hover {
            transform: scale(1.2);
        }

        input[type="submit"] {
            background-color: #0B3D91;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
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
        <h4>Pacientes</h4>
        <span id="msgAlerta"></span>

        <div id="listar-Pacientes">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Sexo</th>
                        <th>Data Nascimento</th>
                        <th>CEP</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado) {
                        if (mysqli_num_rows($resultado) > 0) {
                            while ($row = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['idpacientes']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['cpf']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['sexo']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['data_nascimento']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['cep']) . "</td>";
                                echo "<td class='action-icons'>
                                        <a href='./includeAdm/editar_paciente.php?idpacientes=" . htmlspecialchars($row['idpacientes']) . "'>
                                            <img src='../componentes/imagens/edit1.png' alt='Editar'>
                                        </a>
                                        <a href='./includeAdm/excluir_paciente_listar.php?idpacientes=" . htmlspecialchars($row['idpacientes']) . "' onclick='return confirm(\"Tem certeza de que deseja excluir este paciente?\")'>
                                            <img src='../componentes/imagens/delete.jpg' alt='Excluir'>
                                        </a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>Nenhum paciente encontrado.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Erro ao executar a consulta.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>