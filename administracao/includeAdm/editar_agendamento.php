<?php
// Inicia a sessão e inclui o arquivo de conexão com o banco de dados
session_start();
include('../../DAO/conexao.php');
ob_start();

// Obtém o ID do agendamento da URL
$id_agendamento = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Verifica se o ID do agendamento foi fornecido
if ($id_agendamento === null) {
    echo "ID do agendamento não fornecido.";
    exit();
}

// Consulta o banco de dados para obter os detalhes do agendamento com o ID fornecido
$query = "SELECT * FROM agendamento WHERE id_agendamento = $id_agendamento";
$result = $mysqli->query($query);

// Verifica se a consulta foi bem-sucedida e se encontrou algum agendamento
if ($result && $result->num_rows > 0) {
    // Armazena os detalhes do agendamento em um array associativo
    $agendamento = $result->fetch_assoc();
} else {
    // Se nenhum agendamento for encontrado, exibe uma mensagem de erro e encerra o script
    echo "Agendamento não encontrado.";
    exit();
}

// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Obtém os dados do formulário
    $id_paciente_agendamento = isset($_POST['id_paciente_agendamento']) ? $_POST['id_paciente_agendamento'] : null;
    $cpf_paciente = $_POST['cpf_paciente'];
    $tipo_agendamento = $_POST['tipo_agendamento'];
    $data_agendamento = $_POST['data_agendamento'];
    $hora_agendamento = $_POST['hora_agendamento'];

    // Monta a consulta SQL para atualizar o agendamento no banco de dados
    $update_query = "UPDATE agendamento SET id_paciente_agendamento = '$id_paciente_agendamento', cpf_paciente = '$cpf_paciente', tipo_agendamento = '$tipo_agendamento', data_agendamento = '$data_agendamento', hora_agendamento = '$hora_agendamento' WHERE id_agendamento = $id_agendamento";

    // Executa a consulta SQL de atualização
    if ($mysqli->query($update_query)) {
        // Se a atualização for bem-sucedida, exibe uma mensagem de sucesso e redireciona para a página de histórico de pacientes
        echo "Agendamento atualizado com sucesso.";
        header("Location: ../historico_paciente.php");
        exit();
    } else {
        // Se ocorrer um erro durante a atualização, exibe uma mensagem de erro com detalhes
        echo "Erro ao atualizar o agendamento: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morello - Editar Agendamento</title>
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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../../componentes/imagens/agenda_admin_back.jpg'); /* Substitua 'caminho_para_sua_imagem.jpg' pelo caminho da sua imagem de fundo */
            background-size: cover;
            background-position: center;
        }

        .container {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size : 40px;
            padding: 8px;
        }

        form {
            width: 100%;
            max-width: 800px;
            margin: 0 auto; 
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            font-size: 16px;
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
        }

        input[type="submit"] {
            width: 100%;
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navegacao">
            <img src="../../componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">
            <ul class="nav-menu">
                <li><a href="../portalAdmin.php">Portal Administrativo</a></li>
                <li><a href="../../DAO/logout.php">Sair da Conta</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Editar Agendamento</h2>
        <form action="editar_agendamento.php?id=<?php echo $id_agendamento; ?>" method="post">
            <input type="hidden" name="id_paciente_agendamento" value="<?php echo $agendamento['id_paciente_agendamento']; ?>">

            <label for="cpf_paciente">CPF do Paciente:</label><br>
            <input type="text" id="cpf_paciente" name="cpf_paciente" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" title="Formato de CPF inválido. Use XXX.XXX.XXX-XX" maxlength="14" value="<?php echo $agendamento['cpf_paciente']; ?>" required><br>

            <label for="tipo_agendamento">Tipo de Agendamento:</label>
            <select id="tipo_agendamento" name="tipo_agendamento" required>
                <option value="Consulta Medica" <?php if ($agendamento['tipo_agendamento'] == 'Consulta Medica') echo 'selected'; ?>>Consulta Médica</option>
                <option value="Exame" <?php if ($agendamento['tipo_agendamento'] == 'Exame') echo 'selected'; ?>>Exame</option>
                <option value="Procedimento Médico" <?php if ($agendamento['tipo_agendamento'] == 'Procedimento Médico') echo 'selected'; ?>>Procedimento</option>
            </select><br>

            <label for="data_agendamento">Data do Agendamento:</label><br>
            <input type="date" id="data_agendamento" name="data_agendamento" min="2024-05-01" max="2024-12-31" value="<?php echo $agendamento['data_agendamento']; ?>" required><br>

            <label for="hora_agendamento">Hora da Consulta:</label>
            <input type="time" id="hora_agendamento" name="hora_agendamento" min="08:00" max="18:00" value="<?php echo $agendamento['hora_agendamento']; ?>" required><br>

            <input type="submit" name="submit" value="Atualizar Agendamento">
        </form>
    </div>
</body>
</html>
