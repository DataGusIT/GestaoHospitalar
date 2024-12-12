<?php
session_start();
require_once '../DAO/conexao.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../DAO/login_admin.php");
    exit();
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
            margin: 0px;
            padding: 0px; 
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            list-style: none;
            text-decoration: none;
        }
        .recuo{
            margin-top: 10px;
            background-color: #74AFB2;
        }

        .navegacao{
            background-color: rgba(255, 255, 255, 0.904);
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

        .navegacao h1{
        font-size: 18px;
        }

        .nav-menu {
            display: flex;
            justify-content: center;
            gap: 5rem;
            list-style-type: none;
        }

        .nav-menu li a {
            color: black;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.5s;
        }

        .nav-menu li a:hover {
            color: brown;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start; 
            flex-wrap: wrap;
        }

        .box {
            width: calc(50% - 20px); 
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        .box h2 {
            font-size: 18px;
            text-align: center;
            color: black;
        }
        
        </style>
</head>
<body>

    <header>
        <nav class="navegacao">

            <img src="../componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">

            <h1>Bem vindo ao portal administrativo, <?php echo $_SESSION['nome_usuario']; ?>.</h1>

            <ul class="nav-menu">

                <li><a href="../DAO/logout_admin.php">Sair da Conta</a></li>
                
            </ul>
        </nav>
    </header>


    <div class="dashboard-2">

        <div class="container">
        <div class="box" onclick="location.href='listar_pacientes.php';">
            <h2>Listar Pacientes</h2>
        </div>

        <div class="box" onclick="location.href='cadastro_paciente.php';">
            <h2>Cadastrar Pacientes</h2>
        </div>

    </div>

    <div class="dashboard-3">

        <div class="container">
        <div class="box" onclick="location.href='agendar_paciente.php';">
            <h2>Agendar Consulta</h2>
        </div>


        <div class="box" onclick="location.href='historico_paciente.php';">
            <h2>Histórico de Consultas</h2>
        </div>
    </div>

</body>
</html>

