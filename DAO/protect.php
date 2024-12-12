<?php
session_start();
include('conexao.php');


if (!isset($_SESSION['nome'])) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

        * {
            margin: 0px;
            padding: 0px; 
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            list-style: none;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #74AFB2;
        }

        .mensagem {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 255, 0.5);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 70vh;
            width: 70vw; 
        }

        .mensagem h1 {
            margin-bottom: 10px;
            font-size: 30px;
            color: black;
        }

        .mensagem p {
            margin-bottom: 10px;
            font-size: 25px;
            color: black;
        }

        .mensagem-login a {
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .mensagem-login a:hover {
            background-color: #0056b3;
        }

    </style>

</head>
<body>
    <div class="mensagem">

        <h1> Você não está logado! </h1>
        <br><br>
        <p> Entre, e aproveite todas as funcionalidades<br> que o portal pode oferecer </p>
        <br>

        <div class="mensagem-login">
            <a href="../DAO/login.php">ENTRAR</a>
         </div>
        

    </div>
</body>
</html>
<?php
    die();
    }

    $idpaciente = $_SESSION['idpacientes'];
    $nome = $_SESSION['nome'];

?>

