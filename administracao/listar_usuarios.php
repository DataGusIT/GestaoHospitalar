<?php
session_start();
include_once('../DAO/conexao.php');

if ($_SESSION['id_grupo'] == 2) {
    header('Location: portalUser.php');
}

$idusuario = $_SESSION['idusuario'];

$query_consultas = "SELECT usuarios.idusuarios, usuarios.nome_usuario, usuarios.email_usuario, grupos.descricao
                    FROM usuarios
                    LEFT JOIN grupos ON usuarios.id_grupo = grupos.id_grupos";

$stmt = $mysqli->prepare($query_consultas);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Morello - Usuarios</title>

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
            background-color: #f0f0f0;
        }

        .navegacao {
            background-color: #00274d;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            box-shadow: 0 0.1rem 0.5rem #ccc;
            width: 100%;
        }

        .logo {
            width: 45px;
            height: auto;
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
            /* Azul escuro para o título */
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
            background-color: #f2f2f2;
        }

        .modal {
            display: none;
            /* Oculta a janela modal por padrão */
            position: fixed;
            /* Permite que a janela modal flutue sobre o conteúdo da página */
            z-index: 1;
            /* Define a ordem de empilhamento */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            /* Adiciona rolagem se necessário */
            background-color: rgb(0, 0, 0);
            /* Cor de fundo escura */
            background-color: rgba(0, 0, 0, 0.4);
            /* Cor de fundo escura com transparência */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            /* Centraliza a janela modal verticalmente */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Define a largura da janela modal */
        }

        .fechar-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .fechar-modal:hover,
        .fechar-modal:focus {
            color: black;
            text-decoration: none;
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
        <h4>Usuarios</h4>
        <span id="msgAlerta"></span>

        <div id="listar-Pacientes">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Grupo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <?php
                        if ($stmt) {
                            $stmt->execute();

                            // Armazenar o resultado
                            $stmt->store_result();

                            // Verificar se há consultas retornadas
                            if ($stmt->num_rows > 0) {

                                $stmt->bind_result($idusuarios, $usuario, $email_usuario, $id_grupo);

                                while ($stmt->fetch()) {
                                    echo "<tr>";
                                    echo "<td>" . $idusuarios . "</td>";
                                    echo "<td>" . $usuario . "</td>";
                                    echo "<td>" . $email_usuario . "</td>";
                                    echo "<td>" . $id_grupo . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
                            }

                            $stmt->close();
                        } else {
                            echo "Erro na preparação";
                        }
                        ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>