<?php
require_once 'conexao.php';
session_start(); // Inicia a sessão

$mensagem = "";

if (isset($_POST['cpf']) && isset($_POST['senha'])) {
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    if (strlen($cpf) == 0) {
        $mensagem = "Preencha seu CPF";
    } elseif (strlen($senha) == 0) {
        $mensagem = "Preencha sua senha";
    } else {
        $sql_code = "SELECT * FROM pacientes WHERE cpf = '$cpf' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidadeRequisitos = $sql_query->num_rows;

        if ($quantidadeRequisitos == 1) {
            $pacientes = $sql_query->fetch_assoc();
            $_SESSION['cpf'] = $cpf;
            $_SESSION['nome'] = $pacientes['nome'];
            $_SESSION['idpacientes'] = $pacientes['idpacientes'];

            header("Location: ../includePac/portalPaciente.php");
        } else {
            $mensagem = "Falha ao entrar! CPF ou senha incorretos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Login</title>

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
            background: linear-gradient(270deg, #e0f7fa, #e8f5e9, #ffffff);
            background-size: 600% 600%;
            animation: gradientMove 15s ease infinite;
            color: #333;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }



        .recuo {
            margin-top: 0px;
        }

        .navegacao {
            background-color: #003366;
            /* Azul escuro */
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

        .nav-menu {
            display: flex;
            justify-content: center;
            gap: 5rem;
            list-style-type: none;
        }

        .nav-menu li a {
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            padding: 5px;
            transition: color 0.3s ease;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -3px;
            left: 0;
            background-color: #fff;
            visibility: hidden;
            transition: width 0.3s ease, visibility 0.3s ease;
        }

        .nav-menu li a:hover::after {
            width: 100%;
            visibility: visible;
        }


        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 40px;
            padding: 0 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #003366;
            /* Azul escuro */
        }

        form {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            /* Fundo branco para o formulário */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #003366;
            /* Azul escuro */
            box-shadow: 0 0 5px rgba(0, 51, 102, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #003366;
            /* Azul escuro */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            background-color: #002244;
            /* Azul ainda mais escuro */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
            padding: 10px;
            border: 2px solid red;
            border-radius: 5px;
            background-color: #f8d7da;
        }

        .transition-link {
            color: #003366;
            /* Azul escuro */
            text-decoration: none;
            transition: color 0.3s ease, border-bottom 0.3s ease;
            border-bottom: 2px solid transparent;
        }

        .transition-link:hover {
            color: #002244;
            /* Azul ainda mais escuro */
            border-bottom: 2px solid #002244;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .nav-menu {
                gap: 2rem;
            }

            h2 {
                font-size: 2rem;
            }

            form {
                max-width: 90%;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="recuo"></div>
        <nav class="navegacao">
            <img src="../componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">
            <ul class="nav-menu">
                <li><a href="../index.html">Nosso Hospital</a></li>
                <li><a href="../includePac/portalPaciente.php">Portal do Paciente</a></li>
                <li><a href="../administracao/portalAdmin.php">Portal Empresarial</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Login</h2>

        <form action="" method="POST">
            <div class="formulario">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" title="Formato de CPF inválido. Use XXX.XXX.XXX-XX" maxlength="14" required>
            </div>

            <div class="formulario">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <button type="submit">Login</button>
            <?php if ($mensagem !== ""): ?>
                <p class="error-message"><?php echo $mensagem; ?></p>
            <?php endif; ?>
        </form>

        <p>Ainda não tem uma conta? <a href="cadastro.php" class="transition-link">Clique aqui</a> para se cadastrar.</p>
    </div>

    <script>
        document.getElementById('cpf').addEventListener('input', function(e) {
            var cpf = e.target.value.replace(/\D/g, '');
            if (cpf.length > 0) {
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            e.target.value = cpf;
        });
    </script>
</body>

</html>