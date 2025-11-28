# 📐 Modelagem do Sistema

## 🧩 Descrição das Entidades
- **Usuário:** representa pessoas físicas, protetores/ONGs e administradores.  
- **Gato:** representa os animais cadastrados para adoção.  
- **Solicitação de adoção:** representa o pedido de um tutor para adotar um gato.  
- **Mensagens:** O histórico do chat vinculado a uma solicitação específica..  
---

## 🔗 Descrição dos Relacionamentos
- **Usuário (Protetor/ONG) x Gatos:** Um usuário pode cadastrar múltiplos gatos (**1:N**).  
- **Usuário (Adotante) x Solicitações:** Um usuário pode criar várias solicitações (**1:N**).  
- **Gato x Solicitações:** Um gato pode receber várias solicitações de diferentes pessoas (**N:1**).  
- **Solicitação x Mensagens:** Uma solicitação pode conter várias mensagens de chat (**1:N**).  

---

## 📊 Diagrama ER (Mermaid)

erDiagram
    
    USUARIOS {
        int id PK
        string nome
        string email
        string telefone
        string senha
        enum perfil "adotante, protetor, ong"
        datetime created_at
    }

    GATOS {
        int id PK
        int usuario_id FK "Dono do Gato"
        string nome
        string idade
        text descricao
        string foto
        boolean adotado
        datetime deleted_at "Soft Delete"
    }

    SOLICITACOES {
        int id PK
        int gato_id FK
        int adotante_id FK
        int protetor_id FK
        enum status "pendente, concluida, recusada"
        boolean contato_liberado
    }

    MENSAGENS {
        int id PK
        int solicitacao_id FK
        int remetente_id FK
        text mensagem
        datetime created_at
    }
    
    USUARIOS ||--o{ GATOS : "cadastra"
    USUARIOS ||--o{ SOLICITACOES : "realiza (adotante)"
    USUARIOS ||--o{ MENSAGENS : "envia"
    GATOS ||--o{ SOLICITACOES : "recebe"
    SOLICITACOES ||--o{ MENSAGENS : "contém"


# 📖 Dicionário de Dados  

## 🧑‍💻 Tabela USUARIO  
- **id (PK):** identificador único do usuário.  
- **nome:** nome completo.  
- **email:** endereço de e-mail (único).  
- **telefone:** Telefone para contato.  
- **senha:** senha criptografada.  
- **perfil:** define se o usuário é **adotante**, **protetor/ONG** ou **administrador**.  
- **created_at:** data de criação da conta.

## 🐱 Tabela GATO  
- **id (PK):** identificador único do gato.  
- **nome:** nome do animal.  
- **idade:** idade estimada em anos.  
- **descricao:** breve histórico ou observações. 
- **foto:** Caminho do arquivo da imagem (ex: uploads/foto.jpg).  
- **adotado:** disponível ou adotado.  
- **usuario_id (FK):** referência ao usuário **protetor/ONG** que cadastrou o gato.  
- **deleted_at:** Se preenchido, o gato foi excluído (lixeira).  

## 📩 Tabela SOLICITACAO  
- **id (PK):** identificador único da solicitação.  
- **adotante_id (FK):** referência ao usuário **adotante** que solicita a adoção.  
- **gato_id (FK):** referência ao gato desejado.
- **protetor_id (FK):** Referência ao dono do gato (para facilitar consultas).  
- **status:** Estado atual: 'pendente', 'concluida', 'recusada'.
- **contato_liberado:** 0 (Bloqueado), 1 (Liberado - exibe telefone).

## 📩 Tabela MENSAGENS  
- **id (PK):** Identificador único da mensagem. 
- **solicitacao_id (FK):** Vincula a mensagem a um processo de adoção específico.
- **remetente_id (FK):** Quem enviou a mensagem (Adotante ou Protetor).
- **mensagem (FK):** Conteúdo do texto enviado. 
- **created_at:** Conteúdo do texto enviado.
