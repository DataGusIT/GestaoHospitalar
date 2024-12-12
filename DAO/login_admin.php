<?php
require_once 'conexao.php';
session_start();
$mensagem = "";

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    if (strlen($email) == 0) {
        $mensagem = "Preencha seu email";
    } else if (strlen($senha) == 0) {
        $mensagem = "Preencha sua senha";
    } else {
        $sql_code = "SELECT * FROM usuarios WHERE email_usuario = '$email' AND senha_usuario = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidadeRequisitos = $sql_query->num_rows;

        if ($quantidadeRequisitos == 1) {

            $usuario = $sql_query->fetch_assoc();
            $_SESSION['email'] = $email;
            $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
            $_SESSION['id_grupo'] = $usuario['id_grupo'];
            $_SESSION['idusuario'] = $usuario['idusuario'];

            header("Location: ../administracao/portalAdmin.php");
        } else {
            $mensagem = "Falha ao entrar! Email ou senha incorretos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Login Administrativo</title>
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
            background: linear-gradient(120deg, #f6f9fc, #e9eff3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        header {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .navegacao {
            background-color: #003366;
            /* Azul escuro */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 60px;
            height: auto;
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-menu li a {
            color: #fff;
            /* Texto branco */
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            padding: 5px 0;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #fff;
            /* Linha branca */
            visibility: hidden;
            transition: all 0.3s ease-in-out;
        }

        .nav-menu li a:hover::after {
            width: 100%;
            visibility: visible;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            max-width: 400px;
            margin-top: 80px;
            background: #fff;
            /* Fundo branco para o formulário */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 15px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #003366;
            /* Azul escuro */
            box-shadow: 0 0 8px rgba(0, 51, 102, 0.3);
            outline: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #003366;
            /* Azul escuro */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        button:hover {
            background-color: #002244;
            /* Azul ainda mais escuro */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .error-message {
            color: #d9534f;
            font-weight: 600;
            text-align: center;
            margin: 10px 0;
            padding: 10px;
            border: 2px solid #d9534f;
            border-radius: 5px;
            background-color: #f9d6d5;
        }
    </style>
</head>

<body>

    <header>
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
        <h2>Login Administrativo</h2>

        <form action="" method="POST">

            <div class="formulario">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span id="emailError" style="color: red; display: none;">O email deve ter o formato nomeusuario@gmail.com.</span>
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
    </div>

    <script>
        document.getElementById("email").addEventListener('input', function(e) {
            if (!/^[\w.%+-]+@gmail\.com$/.test(e.target.value)) {
                document.getElementById("emailError").style.display = 'inline';
                e.target.setCustomValidity("Formato de email inválido.");
            } else {
                document.getElementById("emailError").style.display = 'none';
                e.target.setCustomValidity("");
            }
        });
    </script>

</body>

</html>