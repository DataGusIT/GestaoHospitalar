<?php

include('../DAO/conexao.php');
include('../DAO/protect.php');

$idPaciente = $_SESSION['idpacientes'];

function exibirRelatorios($mysqli, $idPaciente)
{
    $sql = "SELECT pacientes.nome, agendamento.tipo_agendamento, agendamento.data_agendamento, relatorios.relatorio
            FROM pacientes
            LEFT JOIN agendamento ON pacientes.idpacientes = agendamento.id_paciente_agendamento
            LEFT JOIN relatorios ON agendamento.id_paciente_agendamento = relatorios.id_paciente_relatorio
            WHERE pacientes.idpacientes = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idPaciente);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["nome"], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row["tipo_agendamento"], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row["data_agendamento"], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td><a href='#' class='ver-relatorio' data-relatorio='" . htmlspecialchars($row["relatorio"], ENT_QUOTES, 'UTF-8') . "'>Exibir</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhuma consulta encontrada.</td></tr>";
    }
    $stmt->close();
}

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
            list-style: none;
            text-decoration: none;
        }

        header {
            background-color: #003366;
            /* Azul escuro para o cabeçalho */
            color: #fff;
            /* Cor do texto no cabeçalho */
        }

        .navegacao {
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

        .navegacao h1 {
            font-size: 18px;
            color: #fff;
            /* Branco para contraste com o fundo escuro */
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
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h4 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 20px;
            color: #003366;
            /* Azul escuro para o título */
        }

        #listar-relatorios {
            margin-top: 20px;
        }

        #listar-relatorios table {
            width: 100%;
            border-collapse: collapse;
        }

        #listar-relatorios th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            background-color: #003366;
            /* Azul escuro para cabeçalhos da tabela */
            color: #fff;
            /* Branco para contraste com o fundo escuro */
        }

        #listar-relatorios td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #listar-relatorios tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #listar-relatorios tr:hover {
            background-color: #f2f2f2;
        }

        .modal {
            display: none;
            /* Oculta a janela modal por padrão */
            position: fixed;
            /* Permite que a janela modal flutue sobre o conteúdo da página */
            z-index: 1;
            /* Define a ordem de empilhamento */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            /* Adiciona rolagem se necessário */
            background-color: rgb(0, 0, 0);
            /* Cor de fundo escura */
            background-color: rgba(0, 0, 0, 0.4);
            /* Cor de fundo escura com transparência */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            /* Centraliza a janela modal verticalmente */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Define a largura da janela modal */
        }

        .fechar-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .fechar-modal:hover,
        .fechar-modal:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <header>
        <div class="recuo"></div>

        <nav class="navegacao">
            <img src="../componentes/imagens/logo2.png" alt="logo da empresa Morello com cores azuis" class="logo">
            <h1>Bem vindo ao portal do paciente, <?php echo $_SESSION['nome']; ?>.</h1>
            <ul class="nav-menu">
                <li><a href="../index.html">Nosso Hospital</a></li>
                <li><a href="portalPaciente.php">Portal do Paciente</a></li>
                <li><a href="../DAO/logout.php">Sair da Conta</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h4>Resultados e Relatórios</h4>

        <div id="listar-relatorios">
            <span id="msgAlerta"></span>

            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo de Agendamento</th>
                        <th>Data do Agendamento</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Exibir os relatórios do paciente
                    exibirRelatorios($mysqli, $idPaciente);
                    $mysqli->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Janela Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="fechar-modal">&times;</span>
            <h2>Detalhes do Relatório</h2>
            <div id="conteudo-relatorio"></div>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
        var modal = document.getElementById("modal");
        var conteudoRelatorio = document.getElementById("conteudo-relatorio");

        document.addEventListener("DOMContentLoaded", function() {
            var linksRelatorio = document.querySelectorAll(".ver-relatorio");

            linksRelatorio.forEach(function(link) {
                link.addEventListener("click", function(event) {
                    event.preventDefault();
                    modal.style.display = "block";
                    var relatorio = this.getAttribute("data-relatorio");
                    conteudoRelatorio.innerHTML = relatorio;
                });
            });
        });

        var btnFechar = document.querySelector(".fechar-modal");
        btnFechar.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    </script>
</body>

</html>