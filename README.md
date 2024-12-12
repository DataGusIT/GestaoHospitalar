# Sistema de Gestão Hospitalar Pediátrico

![Captura de Tela](https://github.com/user-attachments/assets/e5afde00-4038-4f8b-a9d2-babfb80fdd40)

Bem-vindo ao **Sistema de Gestão Hospitalar Pediátrico**! Este projeto foi desenvolvido para gerenciar consultas, exames e procedimentos de forma eficiente e intuitiva. Conta com um sistema de cadastro, login de pacientes, e um portal exclusivo para administradores com funcionalidades completas de gerenciamento.

## Recursos Principais

- **Agendamento de Consultas**: Marque consultas de forma rápida e prática.
- **Agendamento de Exames e Procedimentos**: Planeje exames e procedimentos necessários para os pacientes.
- **Cadastro e Login de Pacientes**: Gerencie os dados dos pacientes com segurança.
- **Exclusão de Consultas**: Permite apagar consultas desnecessárias.
- **Portal do Administrador**: Acesso exclusivo para admins com todas as funcionalidades do sistema.

## Tecnologias Utilizadas

- ![PHP](https://img.shields.io/badge/-PHP-777BB4?style=flat-square&logo=php&logoColor=white) **PHP**
- ![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black) **JavaScript**
- ![HTML5](https://img.shields.io/badge/-HTML5-E34F26?style=flat-square&logo=html5&logoColor=white) **HTML**
- ![CSS3](https://img.shields.io/badge/-CSS3-1572B6?style=flat-square&logo=css3&logoColor=white) **CSS**
- ![MySQL](https://img.shields.io/badge/-MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) **MySQL**
- ![XAMPP](https://img.shields.io/badge/-XAMPP-FB7A24?style=flat-square&logo=xampp&logoColor=white) **XAMPP**

## Instalação e Configuração

Siga os passos abaixo para configurar o sistema:

1. Clone o repositório:

   ```bash
   git clone https://github.com/seu-usuario/sistema-hospitalar-pediatrico.git
   ```

2. Inicie o XAMPP e habilite o **Apache** e o **MySQL**.

3. Importe o banco de dados:

   - Abra o phpMyAdmin no navegador.
   - Crie um novo banco de dados chamado `hospital_pediatrico`.
   - Importe o arquivo SQL fornecido no diretório `database`.

4. Configure o arquivo de conexão no diretório `config/db.php`:

   ```php
   <?php
   $host = 'localhost';
   $user = 'root';
   $password = '';
   $database = 'hospital_pediatrico';
   ?>
   ```

5. Inicie o servidor local:

   - Coloque o projeto na pasta `htdocs` do XAMPP.
   - Acesse o sistema no navegador: `http://localhost/sistema-hospitalar-pediatrico`.

## Contribuição

Sinta-se à vontade para contribuir com o **Sistema de Gestão Hospitalar Pediátrico**! Para isso, siga os passos:

1. Fork este repositório.

2. Crie um branch para a sua feature ou correção:

   ```bash
   git checkout -b minha-feature
   ```

3. Faça as alterações desejadas e commit:

   ```bash
   git commit -m "Adicionei uma nova feature"
   ```

4. Envie suas alterações:

   ```bash
   git push origin minha-feature
   ```

5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

## Contato

- ![Email](https://img.shields.io/badge/-Email-D14836?style=flat-square&logo=gmail&logoColor=white) g.moreno.souza05@gmail.com
- ![LinkedIn](https://img.shields.io/badge/-LinkedIn-0077B5?style=flat-square&logo=linkedin&logoColor=white) [Meu Perfil](https://www.linkedin.com/in/gustavo-moreno-8a925b26a/)

