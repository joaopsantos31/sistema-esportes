# ⚽ Sistema de Gerenciamento de Times de Futebol (CLI em PHP)

## 👨‍🎓 Integrantes do Grupo
- Bruno Furlan  – RA: 2078272
- Adam Rkein – RA: 2022830
- Kaue Augusto Ferreira de Araújo – RA:  233365
- João Pedro Rodrigues dos Santos – RA: 2097331

---

## ⚙️ Passo a Passo para Executar o Projeto

### 1. Pré-requisitos
- Ter o **PHP 8+** instalado.  
  Para confirmar, rode no terminal:
  ```bash
  php -v
  ```
  O sistema deve mostrar a versão do PHP instalada.

- Ter o **Visual Studio Code (VS Code)** (opcional, mas recomendado).

### 2. Obter o projeto
- Faça o download ou clone o repositório na sua máquina.
- Descompacte os arquivos em uma pasta.

### 3. Abrir no VS Code
- Abra a pasta do projeto no VS Code.  
- Abra o terminal integrado (**Ctrl + `**).

### 4. Executar o sistema
No terminal, rode:
```bash
php index.php
```

O menu principal será exibido no terminal.

---

## 📌 Funcionamento do Sistema

Este é um **sistema em linha de comando (CLI)** desenvolvido em PHP para gerenciar **times de futebol**, permitindo:

### 🔹 Times
- Criar um novo time (com nome, região, data de fundação e estádio opcional).  
- Listar os times cadastrados.  
- Excluir um time existente.  
- Consultar informações detalhadas de um time:
  - Nome  
  - Estádio  
  - Região  
  - Data de fundação (formato brasileiro: **dd/mm/aa**)  
  - Técnico  
  - Jogadores  
  - Médicos  
  - Torcedores  

### 🔹 Pessoas
- Adicionar **Jogadores**, **Técnicos**, **Médicos** e **Torcedores** a um time.  
- Remover qualquer pessoa de um time.  

### 🔹 Partidas
- Criar partidas entre dois times cadastrados (com local e data no formato brasileiro).  
- Listar partidas criadas, mostrando:
  - Data  
  - Local  
  - Times participantes  

---

## ▶️ Exemplo de Uso

Ao executar o sistema (`php index.php`), será exibido:

```
======================
 FutSystem
======================

1 - Criar Time
2 - Listar Times
3 - Excluir Time
4 - Adicionar Pessoa em Time
5 - Remover Pessoa de Time
6 - Criar Partida
7 - Listar Partidas
8 - Ver informações de um Time
q - Sair
```

### Criando um time
```
Nome do time: Corinthians
Região: São Paulo
Data de fundação (dd/mm/aa): 01/06/2020
Estádio (opcional, deixe vazio se não tiver): Neo Quimica
Time Corinthians criado!
```

### Exibindo informações de um time
```
====== INFORMAÇÕES DO TIME ======
Nome: Corinthians
Estádio: Neo Quimica
Região: São Paulo
Fundação: 01/06/2020
Técnico: Sem técnico
Jogadores (0): Nenhum
Médicos (0): Nenhum
Torcedores (0): Nenhum
```

---

📌 **Observação:** o sistema é simples, roda diretamente no terminal.
