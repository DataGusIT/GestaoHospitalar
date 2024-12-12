<?php

if (isset($_POST['submit'])) {
    require_once 'conexao.php';

    $cpf = $_POST['cpf'];
    $cpf = mysqli_real_escape_string($mysqli, $cpf);

    $sql_verificar = "SELECT cpf FROM pacientes WHERE cpf='$cpf'";
    $resultado_verificar = mysqli_query($mysqli, $sql_verificar);

    if (empty($cpf)) {
        echo "Campo CPF não pode ser vazio.";
    } else {
        if (mysqli_num_rows($resultado_verificar) > 0) {
            echo "CPF já cadastrado. Por favor, tente novamente com um CPF diferente.";
        } else {
            $nome = $_POST['nome'];
            $data_nascimento = $_POST['data_nascimento'];
            $sexo = $_POST['genero'];
            $telefone = $_POST['telefone'];
            $cep = $_POST['cep'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            // INSERE OS DADOS DO USUÁRIO NA TABELA
            $sql = "INSERT INTO pacientes (cpf, nome, data_nascimento, sexo, telefone, cep, email, senha) 
                    VALUES ('$cpf', '$nome', '$data_nascimento', '$sexo', '$telefone', '$cep', '$email', '$senha')";

            $resultado = mysqli_query($mysqli, $sql);

            if ($resultado) {
                echo "Usuário cadastrado com sucesso";
                header("Location: login.php");
            } else {
                echo "Erro ao cadastrar usuário: " . mysqli_error($mysqli);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Morello - Cadastro</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
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

        header {
            background-color: #003366;
            padding: 20px 0;
            color: #fff;
        }

        .navegacao {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 50px;
        }

        nav {
            display: flex;
        }

        nav ul {
            display: flex;
            padding: 0;
            list-style: none;
            margin: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            /* White text color */
            text-decoration: none;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            position: relative;
            transition: color 0.3s;
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #fff;
            transition: width 0.3s ease-in-out;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        nav ul li a:hover {
            color: #e0e0e0;
            /* Light grey on hover */
        }


        h1 {
            text-align: center;
            margin: 30px 0;
            font-size: 36px;
            color: #003366;
        }

        form {
            width: 90%;
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: linear-gradient(to right, #f9f9f9, #ffffff);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #003366;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="tel"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #0056b3;
            box-shadow: 0 0 8px rgba(0, 0, 255, 0.2);
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #0056b3;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #003d99;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        span {
            display: block;
            margin-top: -10px;
            margin-bottom: 10px;
            font-size: 12px;
            color: red;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navegacao">
            <img src="../componentes/imagens/logo2.png" alt="logo da empresa Morello" class="logo">
            <ul class="nav-menu">
                <li><a href="../index.html">Nosso Hospital</a></li>
                <li><a href="../includePac/portalPaciente.php">Portal do Paciente</a></li>
                <li><a href="../administracao/portalAdmin.php">Portal Empresarial</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <h1>Cadastro de Pacientes</h1>
    <form action="cadastro.php" method="POST">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" title="Formato de CPF inválido. Use XXX.XXX.XXX-XX" maxlength="14" onkeypress="return onlyNumbers(event)" required>
        <span id="cpf-error"></span>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" min="2011-01-01" max="<?php echo date('Y-m-d'); ?>" required>

        <label for="genero">Gênero:</label>
        <select id="genero" name="genero" required>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
        </select>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" required>
        <span id="cepError">O CEP deve ter o formato XXXXX-XXX.</span>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>
        <span id="telefoneError">O telefone deve ter o formato (XX) XXXXX-XXXX ou (XX) XXXX-XXXX.</span>

        <script>
            const telefoneInput = document.getElementById('telefone');
            const telefoneError = document.getElementById('telefoneError');

            telefoneInput.addEventListener('input', function() {
                let value = telefoneInput.value.replace(/\D/g, ''); // Remove tudo que não é número

                // Limitar o comprimento do valor ao necessário para (XX) XXXXX-XXXX
                if (value.length > 11) {
                    value = value.slice(0, 11);
                }

                if (value.length <= 10) {
                    // Formato (XX) XXXX-XXXX
                    value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
                } else {
                    // Formato (XX) XXXXX-XXXX
                    value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
                }

                telefoneInput.value = value;
            });

            telefoneInput.addEventListener('blur', function() {
                const isValid = telefoneInput.checkValidity();

                telefoneError.style.display = isValid ? 'none' : 'inline';
            });
        </script>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@gmail\.com">
        <span id="emailError">O email deve ter o formato nomeusuario@gmail.com.</span>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <input type="submit" name="submit" id="submit" value="Cadastrar">
    </form>

    <script>
        function onlyNumbers(event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        document.getElementById('cpf').addEventListener('input', function(e) {
            var cpf = e.target.value.replace(/\D/g, '');
            if (cpf.length > 0) {
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = cpf;
            }
        });

        document.getElementById('cep').addEventListener('input', function(e) {
            var cep = e.target.value.replace(/\D/g, '');
            if (cep.length > 0) {
                cep = cep.replace(/(\d{5})(\d{0,3})/, '$1-$2');
                e.target.value = cep;
            }
        });
    </script>
</body>

</html>