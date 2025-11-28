# 📋 Requisitos do Sistema

## ✅ Requisitos Funcionais (RF)
1. **Cadastro de usuários** (ONGs, protetores independentes e adotantes).  
2. **Cadastro de gatos** disponíveis para adoção.  
4. **Painel de gestão para ONGs**, permitindo aprovar/rejeitar solicitações de adoção.  
5. **Notificação de usuários** sobre novos gatos cadastrados ou mudança de status.  

---

## ⚙️ Requisitos Não-Funcionais (RNF)
1. **Sistema responsivo**, acessível tanto em navegadores web quanto em dispositivos móveis.  
2. **Proteção de dados** através de criptografia.  
3. **Tempo de resposta rápido**, garantindo boa usabilidade.  

---

## 📏 Regras de Negócio
1. Apenas **ONGs e protetores validados** podem cadastrar gatos no sistema.  

---

## 👥 Perfis de Usuários
- **Adodante:** usuário interessado em adotar gatos, pode criar conta, buscar animais, enviar solicitações e acompanhar status.  
- **Protetor Independente:** usuário om acesso ao painel administrativo, podendo cadastrar animais, gerenciar solicitaçõe.
- **ONG:** organização com acesso ao painel administrativo, podendo cadastrar animais, gerenciar solicitações.  

---

## 📚 Casos de Uso
1. **Cadastro de Usuário**  
   - Ator: Adotante, Protetor, ONG  
   - Fluxo principal: Usuário preenche formulário de cadastro → Sistema valida dados → Conta criada.  

2. **Cadastro de Gato**  
   - Ator: ONG ou Protetor validado  
   - Fluxo principal: Preencher dados do gato (nome, idade, etc.) → Sistema valida informações → Animal fica disponível na plataforma.  

3. **Solicitação de Adoção**  
   - Ator: Adotante  
   - Fluxo principal: Adotante seleciona um gato → Envia solicitação → ONG recebe notificação → Aprova ou rejeita → Adotante é notificado da decisão.  
