# Mapeamento de Rotas e Endpoints

## 1. Autenticação e Cadastro (Público)
Rotas acessíveis por qualquer visitante.

- **GET** `/` - Página inicial (Home).
- **GET** `/login` - Exibe o formulário de login.
- **POST** `/login/autenticar` - Processa as credenciais e inicia a sessão.
- **GET** `/cadastro` - Exibe o formulário de cadastro de usuário.
- **POST** `/cadastro/salvar` - Salva um novo usuário (Adotante ou ONG/Protetor) no banco.
- **GET** `/logout` - Encerra a sessão do usuário.

## 2. Perfil do Usuário (Requer Login)
Rotas acessíveis para qualquer usuário logado (Adotante ou Gestor).

- **GET** `/perfil/editar` - Exibe formulário com dados do usuário para edição.
- **POST** `/perfil/salvar` - Processa a atualização dos dados do perfil.

## 3. Adoção e Visualização (Requer Login)
Área onde os usuários buscam animais.

- **GET** `/gatos/adocao` - Lista os gatos disponíveis para adoção (Vitrine).

## 4. Sistema de Solicitações e Chat (Requer Login)
Gerenciamento do processo de adoção.

- **GET** `/solicitacoes/` - Lista todas as solicitações do usuário (seja ele adotante ou dono do gato).
- **POST** `/solicitacoes/criar` - Cria uma nova intenção de adoção para um gato específico.
- **GET** `/solicitacoes/chat/{id}` - Abre a visualização detalhada e o chat de uma solicitação específica.
- **POST** `/solicitacoes/responder` - Envia uma nova mensagem no chat da solicitação.
- **POST** `/solicitacoes/gerenciar` - Atualiza o status da solicitação (Ex: aceitar, recusar, finalizar).

## 5. Gestão de Gatos (Apenas Gestores/ONGs)
Rotas protegidas pelo filtro `gestor`. Adotantes não têm acesso.

- **GET** `/gatos/meus-gatos` - Lista apenas os gatos cadastrados pelo usuário logado.
- **POST** `/gatos/salvar` - Cadastra um novo gato.
- **POST** `/gatos/editar` - Salva as alterações de um gato existente.
- **GET** `/gatos/excluir/{id}` - Remove (Soft Delete) um gato do sistema.
- **GET** `/gatos/status/{id}` - Alterna a visibilidade do gato (Disponível/Indisponível/Adotado).