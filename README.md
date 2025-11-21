# 🐱 MiauLar - Plataforma de Adoção de Gatos

**MiauLar** é uma plataforma web desenvolvida para conectar gatinhos que precisam de um lar com adotantes amorosos. O sistema permite que ONGs e Protetores Independentes cadastrem seus animais e gerenciem solicitações de adoção através de um chat integrado.

## Tecnologias Utilizadas

* **Back-end:** PHP 7.4.3 / CodeIgniter 4 Framework
* **Front-end:** HTML5, CSS3, Bootstrap 5.3.2
* **Banco de Dados:** MySQL
* **Ambiente de Desenvolvimento:** XAMPP

---

## Funcionalidades

* **Autenticação:** Cadastro e Login com diferenciação de perfis (Adotante, Protetor, ONG).
* **Gestão de Gatos:**
    * Cadastro de gatos com fotos (Upload local ou Link externo).
    * Edição e Exclusão (Soft Delete) de perfis de gatos.
    * Gestão de status (Disponível/Adotado).
* **Adoção:**
    * Fluxo de solicitação de adoção.
    * Chat em tempo real (estilo ticket) entre Adotante e Protetor.
    * Liberação de contato e finalização de adoção.
* **Notificações:**
    * Sistema de notificações visuais (Sininho) para novas solicitações e respostas.
    * Toasts (Alertas flutuantes) para feedback de ações.
* **Segurança:** Proteção CSRF, Hash de senhas e Filtros de Rotas (Guards).

---

## ⚙️ Pré-requisitos

Para rodar este projeto localmente, você precisará ter instalado:

1.  **[XAMPP](https://www.apachefriends.org/pt_br/index.html):** (Para o servidor Apache e banco MySQL).
2.  **[Composer](https://getcomposer.org/):** (Gerenciador de dependências do PHP).
3.  **[Git](https://git-scm.com/):** (Para clonar o repositório).

> **Nota:** Certifique-se de que o PHP habilitado no XAMPP seja a versão **7.4 ou superior** (Recomendado 8.1+).

---

## Passo a Passo de Instalação

### 1. Clonar o Repositório
Abra seu terminal (Git Bash ou CMD) e navegue até a pasta `htdocs` do seu XAMPP (geralmente `C:\xampp\htdocs`) e clone o projeto:

```bash
cd C:\xampp\htdocs
git clone [https://github.com/jailsoncruzz/miaular.git](https://github.com/jailsoncruzz/miaular.git)
cd miaular
```

### 2. Instalar Dependências
Dentro da pasta do projeto, rode o comando do Composer para baixar as bibliotecas do CodeIgniter:

```bash
composer install
```

### 3. Configurar o Banco de Dados
1.  Inicie o **Apache** e o **MySQL** no painel do XAMPP.
2.  Acesse o **phpMyAdmin** (geralmente `http://localhost/phpmyadmin`).
3.  Crie um novo banco de dados chamado: `miaular_db`.
    * *Collation recomendada:* `utf8mb4_general_ci`.

### 4. Configurar Variáveis de Ambiente (.env)
1.  Na raiz do projeto, localize o arquivo `env`.
2.  Renomeie-o para `.env`.
3.  Abra o arquivo e faça as seguintes alterações (remova o `#` do início das linhas para descomentar e ativar):

```ini
# Ambiente de desenvolvimento (Mostra erros detalhados)
CI_ENVIRONMENT = development

# Configuração do Banco de Dados
database.default.hostname = localhost
database.default.database = miaular_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```
> **Nota:** Se você configurou uma senha para o root do MySQL no XAMPP, coloque-a em `database.default.password`.

### 5. Criar as Tabelas (Migrations)
No terminal, dentro da pasta do projeto, execute o comando do CodeIgniter para criar as tabelas (usuários, gatos, solicitações, mensagens) automaticamente:

```bash
php spark migrate
```

---

## Como Rodar o Projeto

1.  Certifique-se que o **MySQL** está rodando no XAMPP.

3.  Acesse em seu navegador:
    **http://localhost/miaular/**

---

## Configuração de Uploads (Importante!)

Para que o upload de fotos dos gatos funcione, o sistema precisa de uma pasta com permissão de escrita. O Git geralmente não envia pastas vazias, então você deve criá-la manualmente:

1.  Vá até a pasta `public`.
2.  Crie uma nova pasta chamada `uploads`.

A estrutura deve ficar assim:
(Crie estas pastas se elas não existirem!)
```text
miaular/
└── public/
    ├── css/
    ├── imgs/
    └── uploads/
```

---

## Guia de Testes (Como usar)

Para testar todas as funcionalidades, recomendo o seguinte fluxo:

1.  **Crie uma conta de ONG:**
    * Vá em Cadastrar -> Selecione "Protetor/ONG".
    * Faça login e clique em "Adicionar" para cadastrar alguns gatos.
2.  **Crie uma conta de Adotante:**
    * Abra uma aba anônima (ou use outro navegador).
    * Vá em Cadastrar -> Selecione "Adotante".
    * Vá na página de Adoção, escolha um gato e clique em "Quero Adotar".
3.  **Interaja:**
    * Volte na conta da ONG.
    * Observe o **Sininho de Notificação** vermelho no menu.
    * Clique nele para ver a solicitação, responda o chat e libere o contato ou conclua a adoção.

---
