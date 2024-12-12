<?php
// Inicia a sessão e inclui o arquivo de conexão com o banco de dados
session_start();
include('../../DAO/conexao.php');

// Verifica se o ID do paciente foi fornecido na URL e se é um número válido
if (!isset($_GET['idpacientes']) || !is_numeric($_GET['idpacientes'])) {
    // Se o ID do paciente não for válido, encerra o script e exibe uma mensagem de erro
    die("ID de paciente inválido.");
}

// Obtém o ID do paciente da URL e converte para inteiro
$idpacientes = (int) $_GET['idpacientes'];

// Busca os dados do paciente no banco de dados com base no ID fornecido
$query_buscar = "SELECT * FROM pacientes WHERE idpacientes = '$idpacientes'";
$resultado_buscar = mysqli_query($mysqli, $query_buscar);

// Verifica se o paciente foi encontrado com o ID fornecido
if (mysqli_num_rows($resultado_buscar) == 0) {
    // Se o paciente não for encontrado, encerra o script e exibe uma mensagem de erro
    die("Paciente não encontrado.");
}

// Armazena os dados do paciente em um array associativo
$paciente = mysqli_fetch_assoc($resultado_buscar);

// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Recupera os dados do formulário e realiza a devida validação e sanitização
    $cpf = mysqli_real_escape_string($mysqli, $_POST['cpf']);
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $data_nascimento = mysqli_real_escape_string($mysqli, $_POST['data_nascimento']);
    $sexo = mysqli_real_escape_string($mysqli, $_POST['genero']);
    $telefone = mysqli_real_escape_string($mysqli, $_POST['telefone']);
    $cep = mysqli_real_escape_string($mysqli, $_POST['cep']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $senha = mysqli_real_escape_string($mysqli, $_POST['senha']);

    // Monta a consulta SQL para atualizar os dados do paciente no banco de dados
    $query_atualizar = "UPDATE pacientes SET 
                        cpf='$cpf', 
                        nome='$nome', 
                        data_nascimento='$data_nascimento', 
                        sexo='$sexo', 
                        telefone='$telefone', 
                        cep='$cep', 
                        email='$email', 
                        senha='$senha' 
                        WHERE idpacientes='$idpacientes'";

    // Executa a consulta SQL de atualização
    if (mysqli_query($mysqli, $query_atualizar)) {
        // Se a atualização for bem-sucedida, exibe uma mensagem de sucesso e redireciona para a página de listagem de pacientes
        echo "Paciente atualizado com sucesso!";
        header("Location: ../listar_pacientes.php");
        exit();
    } else {
        // Se ocorrer um erro durante a atualização, exibe uma mensagem de erro com detalhes
        echo "Erro ao atualizar o paciente: " . mysqli_error($mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
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
    background-color: midnightblue;
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

    h1 {
        text-align: center;
        margin-top: 30px;
        font-size: 40px;
        margin-bottom: 20px;
        font-size : 40px
    }

        form {
        width: 100%;
        max-width: 800px;
        margin: 0 auto; 
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="tel"],
    input[type="email"],
    input[type="password"],
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
                <li><a href="../../DAO/logout_admin.php">Sair da Conta</a></li>
            </ul>
        </nav>
    </header>

    <h1>Editar Paciente</h1>
    <form action="editar_paciente.php?idpacientes=<?php echo $idpacientes; ?>" method="POST">

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" title="Formato de CPF inválido. Use XXX.XXX.XXX-XX" maxlength="14" onkeypress="return onlyNumbers(event)" value="<?php echo $paciente['cpf']; ?>"required>
        <span id="cpf-error" style="color: red;"></span><br>
        <script>
            // Função para formatar o CPF conforme o usuário digita
            document.getElementById('cpf').addEventListener('input', function (e) {
                var cpf = e.target.value.replace(/\D/g, '');
                if (cpf.length > 0) {
                    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                }
                e.target.value = cpf;

                var symbol = document.getElementById('cpfSymbol');
                if (cpf.length === 14) {
                    symbol.innerHTML = '<i class="bi bi-check-circle correct"></i>';
                } else {
                    symbol.innerHTML = '<i class="bi bi-x-circle incorrect"></i>';
                }
            });
        </script>

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo $paciente['nome']; ?>" required><br><br>
        <script>
            document.getElementById("nome").addEventListener('input', function(e) {
            var nome = e.target.value;
            var apenasLetras = /^[a-zA-Z\s]*$/;

            if (!apenasLetras.test(nome)) {
                e.target.value = nome.replace(/[^a-zA-Z\s]/g, '');
             }
         });
        </script>

        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" min="2011-01-01" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $paciente['data_nascimento']; ?>" required><br><br>
        <script>
            document.getElementById('data_nascimento').addEventListener('input', function (e) {
            var inputDate = new Date(e.target.value);
            var minDate = new Date('2011-01-01');

            if (inputDate < minDate) {
                e.target.setCustomValidity('Por favor, selecione ou digite uma data de nascimento a partir de 2011.');
            } else {
                e.target.setCustomValidity('');
            }
             });
        </script>

        <label for="genero">Gênero:</label><br>
        <select id="genero" name="genero" required>
            <option value="Masculino" <?php if ($paciente['sexo'] == 'Masculino') echo 'selected'; ?>>Masculino</option>
            <option value="Feminino" <?php if ($paciente['sexo'] == 'Feminino') echo 'selected'; ?>>Feminino</option>
            <option value="Outro" <?php if ($paciente['sexo'] == 'Outro') echo 'selected'; ?>>Outro</option>
        </select><br><br>

        <label for="cep">CEP:</label><br>
        <input type="text" id="cep" name="cep" value="<?php echo $paciente['cep']; ?>" required><br><br>
        <script>
        document.getElementById("cep").addEventListener('input', function(e) {
            var cep = e.target.value.replace(/\D/g, '');
            if (cep.length > 8) {
                cep = cep.substring(0, 8);
            }
            // Formatar o CEP
            var formattedCep = cep;
            if (cep.length === 8) {
                formattedCep = cep.replace(/(\d{5})(\d{3})/, '$1-$2');
            }
            e.target.value = formattedCep;
            if (!/^\d{5}-\d{3}$/.test(formattedCep)) {
                document.getElementById("cepError").style.display = 'inline';
                e.target.setCustomValidity("Formato de CEP inválido.");
            } else {
                document.getElementById("cepError").style.display = 'none';
                e.target.setCustomValidity("");
            }
        });
        </script>

        <label for="telefone">Telefone:</label><br>
        <input type="tel" id="telefone" name="telefone" value="<?php echo $paciente['telefone']; ?>" required><br><br>
        <script>
            document.getElementById("telefone").addEventListener('input', function(e) {
                var telefone = e.target.value.replace(/\D/g, '');

                // Limitar o telefone a 11 caracteres
                if (telefone.length > 11) {
                    telefone = telefone.substring(0, 11);
                }

                // Formatar o telefone
                var formattedTelefone;
                if (telefone.length === 11) {
                    formattedTelefone = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                } else if (telefone.length === 10) {
                    formattedTelefone = telefone.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                } else {
                    formattedTelefone = telefone;
                }

                e.target.value = formattedTelefone;

                // Verificar se o telefone tem um dos formatos esperados
                if (!/^(\(\d{2}\) \d{5}-\d{4})|(\(\d{2}\) \d{4}-\d{4})$/.test(formattedTelefone)) {
                    document.getElementById("telefoneError").style.display = 'inline';
                    e.target.setCustomValidity("Formato de telefone inválido.");
                } else {
                    document.getElementById("telefoneError").style.display = 'none';
                    e.target.setCustomValidity("");
                }
            });
            </script>


        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $paciente['email']; ?>" required><br>
        <span id="emailError" style="color: red; display: none;">O email deve ter o formato nomeusuario@gmail.com.</span><br>

        <script>
        document.getElementById("email").addEventListener('input', function(e) {
         // Verificar se o email tem o formato esperado
            if (!/^[\w.%+-]+@gmail\.com$/.test(e.target.value)) {
             document.getElementById("emailError").style.display = 'inline';
             e.target.setCustomValidity("Formato de email inválido.");
         } else {
             document.getElementById("emailError").style.display = 'none';
             e.target.setCustomValidity("");
         }
        });
        </script>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" value="<?php echo $paciente['senha']; ?>" required><br><br>

        <input type="submit" name="submit" value="Salvar Alterações">
    </form>

</body>
</html>
