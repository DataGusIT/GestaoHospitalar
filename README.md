# Sistema de Gestão Hospitalar Pediátrico

> Plataforma completa para gestão hospitalar focada no atendimento pediátrico

[![Status](https://img.shields.io/badge/Status-Em%20Finalizado-success)](https://github.com/DataGusIT/sistema-hospitalar-pediatrico)
[![Version](https://img.shields.io/badge/Version-1.0.0-blue)](https://github.com/seu-usuario/sistema-hospitalar-pediatrico/releases)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4)](https://php.net/)

## Sobre

O Sistema de Gestão Hospitalar Pediátrico é uma solução completa desenvolvida para otimizar o fluxo de trabalho em ambientes hospitalares especializados no atendimento infantil. O sistema prioriza a eficiência operacional e uma experiência mais humanizada para pacientes e famílias.

## Funcionalidades

### 🗓️ Gestão de Agendamentos
- Agendamento inteligente de consultas com prevenção de conflitos
- Programação automatizada de exames laboratoriais
- Coordenação de procedimentos médicos e recursos

### 👨‍👩‍👧‍👦 Portal do Paciente
- Cadastro simplificado para famílias
- Histórico médico completo e acessível
- Acompanhamento de consultas e tratamentos

### 👑 Portal Administrativo
- Dashboard com métricas em tempo real
- Gestão de equipes e escalas médicas
- Relatórios customizáveis e exportação de dados
- Controle financeiro integrado

## Tecnologias

### Backend
- **PHP 8.1+** - Linguagem principal
- **MySQL 8.0** - Banco de dados
- **XAMPP** - Ambiente de desenvolvimento

### Frontend
- **HTML5** - Estrutura semântica
- **CSS3** - Design responsivo
- **JavaScript ES6** - Interatividade

### Arquitetura
- **MVC Pattern** - Separação de responsabilidades
- **RESTful APIs** - Comunicação entre camadas
- **Responsive Design** - Compatibilidade multi-dispositivo

## Pré-requisitos

- [XAMPP 8.1+](https://www.apachefriends.org/) ou servidor web equivalente
- [PHP 8.1+](https://php.net/downloads.php)
- [MySQL 8.0+](https://dev.mysql.com/downloads/mysql/)
- Navegador web moderno

## Instalação

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/sistema-hospitalar-pediatrico.git
   cd sistema-hospitalar-pediatrico
   ```

2. **Configure o XAMPP**
   - Inicie Apache e MySQL no painel de controle
   - Verifique as portas 80 (Apache) e 3306 (MySQL)

3. **Preparar banco de dados**
   ```bash
   # Acesse http://localhost/phpmyadmin
   # Crie o banco: hospital_pediatrico
   # Importe: database/schema.sql
   # Importe: database/seed.sql
   ```

4. **Configurar conexão**
   ```php
   // config/db.php
   <?php
   $host = 'localhost';
   $user = 'root';
   $password = '';
   $database = 'hospital_pediatrico';
   $port = 3306;
   ?>
   ```

5. **Instalar aplicação**
   ```bash
   # Mover para diretório web
   cp -r . /xampp/htdocs/sistema-hospitalar-pediatrico/
   
   # Configurar permissões (Linux/Mac)
   chmod -R 755 .
   chmod -R 777 uploads/
   ```

6. **Acessar sistema**
   ```
   http://localhost/sistema-hospitalar-pediatrico
   ```

### Credenciais de Teste

**Administrador:**
- Email: `carlaplr@hospital.com`
- Senha: `root123`

**Paciente Demo:**
- Email: `familia@exemplo.com`
- Senha: `familia123`

## Estrutura do Projeto

```
sistema-hospitalar-pediatrico/
├── config/              # Configurações do sistema
├── controllers/         # Controladores MVC
├── models/             # Modelos de dados
├── views/              # Templates e interfaces
├── assets/             # CSS, JS, imagens
├── database/           # Scripts SQL
├── uploads/            # Arquivos enviados
└── includes/           # Arquivos auxiliares
```

## Arquitetura

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│  Portal Paciente│    │Portal Administr.│    │   Dashboard     │
└─────────┬───────┘    └─────────┬───────┘    └─────────┬───────┘
          │                      │                      │
          └──────────────────────┼──────────────────────┘
                                 │
                    ┌─────────────┴───────────┐
                    │   Camada Controle       │
                    └─────────────┬───────────┘
                                 │
                    ┌─────────────┴───────────┐
                    │   Camada Serviços       │
                    └─────────────┬───────────┘
                                 │
                    ┌─────────────┴───────────┐
                    │ Camada Acesso Dados     │
                    └─────────────┬───────────┘
                                 │
                    ┌─────────────┴───────────┐
                    │    MySQL Database       │
                    └─────────────────────────┘
```

## Equipe

| Nome | Função | LinkedIn |
|------|--------|----------|
| **Gustavo Moreno Souza** | Desenvolvedor Full-Stack | [LinkedIn](https://www.linkedin.com/in/gustavo-moreno-8a925b26a/) |
| **Giovanna Joaquim** | Desenvolvedora Frontend | [LinkedIn](https://www.linkedin.com/in/giovanna-j-29651921a/) |
| **Carla Araujo** | Desenvolvedora Backend | [LinkedIn](https://www.linkedin.com/in/carla-araujo-b50956265/) |

## Roadmap

- [x] **v1.0** - Sistema base com funcionalidades essenciais
- [ ] **v1.1** - Integração com laboratórios externos
- [ ] **v1.2** - Aplicativo mobile para pacientes
- [ ] **v1.3** - Módulo de telemedicina
- [ ] **v2.0** - IA para análise preditiva

## Contribuição

Contribuições são bem-vindas! Para contribuir:

1. Fork o projeto
2. Crie uma branch (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

### Diretrizes

- Siga os padrões de código existentes
- Teste todas as funcionalidades antes do commit
- Documente mudanças significativas
- Use mensagens de commit descritivas

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

## Suporte

Para suporte técnico ou dúvidas:

- **Email**: [g.moreno.souza05@gmail.com](mailto:g.moreno.souza05@gmail.com)
- **LinkedIn**: [Gustavo Moreno](https://www.linkedin.com/in/gustavo-moreno-8a925b26a/)

---

<div align="center">
  Desenvolvido por Gustavo Moreno, Carla Cristina e Giovanna Joaquim
</div>
