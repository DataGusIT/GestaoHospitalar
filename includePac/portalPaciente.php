<?php
include('../DAO/conexao.php');
include('../DAO/protect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Portal do Paciente</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
        }

        body {
            background-color: #f5f7f9;
            font-family: Arial, sans-serif;
            color: #333;
        }

        header {
            background-color: #003366;
            /* Azul escuro */
            color: #fff;
            padding: 20px 40px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .navegacao {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navegacao h1 {
            font-size: 18px;
            margin: 0;
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
            margin: 40px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .box {
            width: calc(33.33% - 20px);
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .box img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .box h2 {
            font-size: 20px;
            color: #003366;
            /* Azul escuro */
        }
    </style>
</head>

<body>

    <header>
        <div class="navegacao">
            <img src="../componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">
            <h1>Bem-vindo ao portal do paciente, <?php echo $_SESSION['nome']; ?>.</h1>
            <ul class="nav-menu">
                <li><a href="../index.html">Nosso Hospital</a></li>
                <li><a href="portalPaciente.php">Portal do Paciente</a></li>
                <li><a href="../DAO/logout.php">Sair da Conta</a></li>
            </ul>
        </div>
    </header>

    <div class="container">
        <div class="box" onclick="location.href='agendamento.php';">
            <img src="../componentes/imagens/historico1.png" alt="Agendar Consulta">
            <h2>Agendar Consulta</h2>
        </div>

        <div class="box" onclick="location.href='resultados.php';">
            <img src="../componentes/imagens/historico2.png" alt="Ver Resultados">
            <h2>Ver Resultados</h2>
        </div>

        <div class="box" onclick="location.href='historico.php';">
            <img src="../componentes/imagens/historico3.png" alt="Histórico de Consultas">
            <h2>Histórico de Consultas</h2>
        </div>
    </div>

</body>

</html>