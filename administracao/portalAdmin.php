<?php
session_start();
require_once '../DAO/conexao.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../DAO/login_admin.php");
    exit();
}

if ($_SESSION['id_grupo'] == 2) {
    header('Location: portalUser.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administrativo - Morello</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #003366;
            color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            width: 60px;
            height: auto;
        }

        .header-title {
            font-size: 1.2rem;
            font-weight: 500;
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

        .container {
            max-width: 1200px;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .box {
            flex: 1;
            min-width: calc(50% - 20px);
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            cursor: pointer;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        .box h2 {
            font-size: 1.5rem;
            color: #003366;
            text-align: center;
        }
    </style>
</head>

<body>

    <header>
        <div class="header-container">
            <img src="../componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">
            <div class="header-title">Bem-vindo ao portal administrativo, <?php echo $_SESSION['nome_usuario']; ?>.</div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="../DAO/logout_admin.php">Sair da Conta</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="box" onclick="location.href='listar_usuarios.php';">
            <h2>Listar Usuários</h2>
        </div>
        <div class="box" onclick="location.href='listar_pacientes.php';">
            <h2>Listar Pacientes</h2>
        </div>
        <div class="box" onclick="location.href='includeAdm/cadastro_paciente.php';">
            <h2>Cadastrar Pacientes</h2>
        </div>
        <div class="box" onclick="location.href='includeAdm/agendar_paciente.php';">
            <h2>Agendar Consulta</h2>
        </div>
        <div class="box" onclick="location.href='historico_paciente.php';">
            <h2>Histórico de Consultas</h2>
        </div>
    </div>

</body>

</html>