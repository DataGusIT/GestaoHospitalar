<?php
include('../DAO/conexao.php');
include('../DAO/protect.php');
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Agendar Consultas</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            list-style: none;
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
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 20px;
            color: #003366;
            /* Azul escuro */
        }

        form {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
            /* Transição suave para os efeitos */
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        select:focus {
            border-color: #003366;
            /* Cor da borda ao focar */
            box-shadow: 0 0 5px rgba(0, 51, 102, 0.5);
            /* Sombra ao focar */
        }

        input[type="submit"] {
            width: 100%;
            background-color: #003366;
            /* Azul escuro */
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
            /* Azul mais escuro ao passar o mouse */
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
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
        <h2>Agendar Consulta</h2>

        <form action="agendamento.php" method="post">
            <input type="hidden" name="id_paciente_agendamento" value="<?php echo isset($_SESSION['idpacientes']) ? $_SESSION['idpacientes'] : ''; ?>">

            <label for="tipo_agendamento">Tipo de Agendamento:</label>
            <select id="tipo_agendamento" name="tipo_agendamento" required>
                <option value="Consulta Medica">Consulta Médica</option>
                <option value="Exame">Exame</option>
                <option value="Procedimento Médico">Procedimento</option>
            </select>

            <label for="data_agendamento">Data do Agendamento:</label>
            <input type="date" id="data_agendamento" name="data_agendamento" required>

            <label for="hora_agendamento">Hora da Consulta:</label>
            <input type="time" id="hora_agendamento" name="hora_agendamento" required>

            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_SESSION['idpacientes']) && isset($_POST['tipo_agendamento']) && isset($_POST['data_agendamento']) && isset($_POST['hora_agendamento'])) {
                    $id_paciente_agendamento = $_SESSION['idpacientes'];
                    $tipo_agendamento = $_POST['tipo_agendamento'];
                    $data_agendamento = $_POST['data_agendamento'];
                    $hora_agendamento = $_POST['hora_agendamento'];

                    // Verificar se já existe um agendamento na mesma data e hora
                    $check_query = "SELECT * FROM agendamento WHERE id_paciente_agendamento != $id_paciente_agendamento AND data_agendamento = '$data_agendamento' AND hora_agendamento = '$hora_agendamento'";
                    $check_result = $mysqli->query($check_query);

                    if ($check_result) {
                        if ($check_result->num_rows > 0) {
                            echo "<div class='error-message'>Desculpe, já existe um agendamento para outro paciente na mesma data e horário.</div>";
                        } else {
                            // Inserir o novo agendamento
                            $insert_query = "INSERT INTO agendamento (id_paciente_agendamento, tipo_agendamento, data_agendamento, hora_agendamento) VALUES ($id_paciente_agendamento, '$tipo_agendamento', '$data_agendamento', '$hora_agendamento')";
                            $insert_result = $mysqli->query($insert_query);

                            if ($insert_result) {
                                header("Location: historico.php");
                                exit();
                            } else {
                                echo "<div class='error-message'>Não foi possível realizar o agendamento.</div>";
                            }
                        }
                    } else {
                        echo "<div class='error-message'>Erro na execução da consulta: " . $mysqli->error . "</div>";
                    }
                }
            }
            ?>

            <input type="submit" id="agendar" name="submit" value="Agendar">
        </form>
    </div>

    <script>
        // Função para formatar a data no formato YYYY-MM-DD
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

        // Definir a data mínima como amanhã
        var today = new Date();
        var tomorrow = new Date();
        tomorrow.setDate(today.getDate() + 1);

        var minDate = formatDate(tomorrow);
        document.getElementById('data_agendamento').setAttribute('min', minDate);

        document.getElementById('data_agendamento').addEventListener('input', function(e) {
            var inputDate = new Date(e.target.value);
            var minDate = new Date();
            minDate.setDate(minDate.getDate() + 1);

            if (inputDate < minDate) {
                e.target.setCustomValidity('Por favor, selecione uma data a partir de amanhã.');
            } else {
                e.target.setCustomValidity('');
            }
        });
    </script>
</body>

</html>