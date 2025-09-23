<?php 
declare(strict_types=1); // o php por padrão tenta converter valores quando vc passa
// um tipo eerrado para uma função, com o tipo estrito isso não acontece
// o erro é acusado, isso aumenta a segurança do código, é mais importante no caso
// de projetos maiores, mesmo assim é interessante para evitar problemas

use SistemaEsportes\Classes\Pessoa;
use SistemaEsportes\Classes\Jogador;
use SistemaEsportes\Classes\Juiz;
use SistemaEsportes\Classes\Torcedor;
use SistemaEsportes\Classes\Time;
use SistemaEsportes\Classes\Partida;
use SistemaEsportes\Classes\Medico; // importando as classes 
use SistemaEsportes\Classes\Tecnico;

require __DIR__ . '/vendor/autoload.php'; // para carregar as classes do projeto com o autoload composer

$partidas = []; // array para armazenar as partidas agendadas

// Função para "limpar" a tela (pula 50 linhas)
function limparTela(): void {
    for ($contador = 0; $contador < 50; $contador++){
        echo "\n";
    }
}

// Real Madrid - time padrão (criação do time)
$realMadrid = new Time(
    'Real Madrid',
    'Madrid, Espanha',
    new DateTime('1902-03-06'), // date time transforma o string em data
    'Santiago Bernabéu'
);

// Criação do Elenco do Real
$realMadrid->contratarJogador(new Jogador('Thibaut Courtois', 33, 'Bélgica', 1.99, 96, 'Goleiro', 1, 'Esquerda'));
$realMadrid->contratarJogador(new Jogador('Dani Carvajal', 33, 'Espanha', 1.73, 73, 'Lateral Direito', 2, 'Direita'));
$realMadrid->contratarJogador(new Jogador('Éder Militão', 27, 'Brasil', 1.86, 80, 'Zagueiro', 3, 'Direita')); 
$realMadrid->contratarJogador(new Jogador('Álex Carreras', 22, 'Espanha', 1.85, 78, 'Zagueiro', 18, 'Esquerda'));
$realMadrid->contratarJogador(new Jogador('Raúl Asencio', 25, 'Espanha', 1.80, 75, 'Lateral Esquerdo', 17, 'Esquerda'));
$realMadrid->contratarJogador(new Jogador('Aurélien Tchouaméni', 25, 'França', 1.87, 80, 'Volante', 14, 'Direita'));
$realMadrid->contratarJogador(new Jogador('Federico Valverde', 27, 'Uruguai', 1.82, 80, 'Meia Central', 8, 'Direita'));
$realMadrid->contratarJogador(new Jogador('Mastantuono', 21, 'Brasil', 1.80, 75, 'Meia Ofensivo', 30, 'Esquerda'));
$realMadrid->contratarJogador(new Jogador('Vinícius Júnior', 25, 'Brasil', 1.76, 73, 'Ponta Esquerda', 7, 'Direita'));
$realMadrid->contratarJogador(new Jogador('Kylian Mbappé', 26, 'França', 1.78, 73, 'Ponta Direita', 10, 'Direita'));
$realMadrid->contratarJogador(new Jogador('Gonzalo García', 22, 'Brasil', 1.85, 80, 'Centroavante', 16, 'Direita'));

// Barcelona - time padrão (criação do time)
$barcelona = new Time(
    'FC Barcelona',
    'Barcelona, Espanha',
    new DateTime('1899-11-29'), // transforma string em data
    'Camp Nou'
);

// Criação do Elenco do Barça
$barcelona->contratarJogador(new Jogador('Ter Stegen', 33, 'Alemanha', 1.94, 85, 'Goleiro', 1, 'Direita'));
$barcelona->contratarJogador(new Jogador('Alejandro Balde', 21, 'Espanha', 1.78, 70, 'Lateral Esquerdo', 3, 'Esquerda'));
$barcelona->contratarJogador(new Jogador('Ronald Araújo', 26, 'Uruguai', 1.88, 82, 'Zagueiro', 4, 'Direita'));
$barcelona->contratarJogador(new Jogador('Pau Cubarsí', 18, 'Espanha', 1.85, 78, 'Zagueiro', 5, 'Esquerda'));
$barcelona->contratarJogador(new Jogador('Jules Koundé', 26, 'França', 1.82, 78, 'Lateral Direito', 2, 'Direita'));
$barcelona->contratarJogador(new Jogador('Pedri', 22, 'Espanha', 1.74, 60, 'Meia Central', 8, 'Esquerda'));
$barcelona->contratarJogador(new Jogador('Fermín López', 22, 'Espanha', 1.75, 70, 'Meia Central', 21, 'Esquerda'));
$barcelona->contratarJogador(new Jogador('Gavi', 21, 'Espanha', 1.74, 68, 'Meia Central', 6, 'Esquerda'));
$barcelona->contratarJogador(new Jogador('Lamine Yamal', 17, 'Espanha', 1.70, 60, 'Ponta Esquerda', 11, 'Esquerda'));
$barcelona->contratarJogador(new Jogador('Raphinha', 28, 'Brasil', 1.76, 74, 'Ponta Direita', 22, 'Esquerda'));
$barcelona->contratarJogador(new Jogador('Robert Lewandowski', 37, 'Polônia', 1.84, 79, 'Centroavante', 9, 'Direita'));

// Armazenando os times em caixa alta na array de times 
$times[strtoupper("Real Madrid")] = $realMadrid; 
$times[strtoupper("FC Barcelona")] = $barcelona; 

// Partida inicial agendada entre real e barça
$partidaInicial = new Partida(
    new DateTime('2025-10-26'), 
    'Santiago Bernabéu',
    [$realMadrid, $barcelona]
);
$partidas[] = $partidaInicial; // add a partida a lista de partidas iniciais

// Função do Menu
function exibirMenu(): void
{
    limparTela(); // chama a função de limpar tela antes de exibir o menu
    echo "\n======================\n";
    echo " FuteSystem\n";
    echo "======================\n\n";

    echo "[1] - Criar time\n";
    echo "[2] - Listar times\n";
    echo "[3] - Excluir time\n";
    echo "[4] - Adicionar pessoa em um time\n";
    echo "[5] - Remover pessoa de um time\n";
    echo "[6] - Agendar partida\n";
    echo "[7] - Listar partidas agendadas\n";
    echo "[8] - Ver informações de um time\n";
    echo "[Q] - Sair do sistema\n";
}

while (true) { // loop geral
    exibirMenu();

    echo "\nDigite a opção desejada: ";
    $entrada = trim(readline()); //  trim tira espaços

    if (strtoupper($entrada) === "Q") { 
        echo "Saindo do sistema. Até a próxima!!...\n"; 
        break;
    }

    $opcao = (int) $entrada; // convertendo pra int 

    switch ($opcao) {
        case 1:
            limparTela();
            echo "=== Criar Time ===\n\n";

            echo "Times já cadastrados: \n\n";
            foreach ($times as $t) {
                echo "- {$t->nome}\n"; // autoexplicativo
            }

            echo "\n";
            $nome = readline("Nome do time: "); // input de nome do time

            if (isset($times[strtoupper($nome)])){ 
                echo "O time $nome já está cadastrado no sistema.\n"; // checa se ja tem no sistema
                readline("\nDigite enter para voltar ao menu..");
                break;
            }

            $regiao = readline("Região do time (Cidade, País): ");
            $dataFund = readline("Data de fundação (dd/mm/AAAA): ");
            $fundacao = DateTime::createFromFormat('d/m/Y', $dataFund); 
            $estadio = readline("Estádio (opcional, deixe vazio se não tiver): "); 

            // Armazenando em caixa alta
            $times[strtoupper($nome)] = new Time($nome, $regiao, $fundacao, $estadio); // transforma a chave da array do time criado agora em caixa alta, evitando problema em busca
            echo "Time criado com sucesso!\n";
            readline("\nDigite enter para voltar ao menu...");
            break;

        case 2:
            limparTela();
            echo "=== Listar times ===\n\n";
            if (empty($times)) { // confere se array de time n ta vazia
                echo "Nenhum time cadastrado no sistema.\n";
            } else {
                foreach ($times as $t) {
                    echo "- {$t->nome}\n"; // percorre os times cadastrados na array de times
                }
            }
            readline("\nPressione enter para voltar ao menu..."); // mensagem antes de voltar para o menu
            break;

        case 3:
            limparTela();
            echo "=== Excluir Time ===\n\n";
            foreach ($times as $t) {
                echo "- {$t->nome}\n"; // percorre times
            }

            echo "\n";
            $nome = strtoupper(readline("Nome do time que vai ser excluido: "));

            if (isset($times[$nome])) { // testa se o time que o usuário escolheu pra excluir realmente está cadastrado
                unset($times[$nome]); // tira o time da array de times
                echo "Time removido. Adeus!\n"; 
            } else {
                echo "Time não encontrado no sistema.\n"; 
            }

            readline("\nDigite enter para voltar ao menu...");
            break;

        case 4:
            limparTela();
            echo "=== Adicionar pessoa em time ===\n\n";

             if (empty($times)) { // testa se a array de times tá vazia
                echo "Nenhum time cadastrado no sistema.\n"; // autoexplicativo
                readline("\nDigite enter para voltar ao menu...");
            break;
            }

            echo "Times cadastrados no sistema:\n\n";
            foreach ($times as $t) {
            echo "- {$t->nome}\n"; // percorre os times da array de times
            }

             echo "\n";
            $timeNome = strtoupper(readline("Nome do time: ")); // formata o input pra caixa alta

            if (!isset($times[$timeNome])) { // testa se o time ta cadastrado
            echo "O time não existe.\n"; 
            readline("\nDigite enter para voltar ao menu...");
            break;
        }

            echo "\nDigite o número da sua escolha: ";
            echo "\n[1] Jogador | [2] Técnico | [3] Médico | [4] Torcedor: ";
            $tipo = (int)readline(); // converte pra int

        switch ($tipo) {
            case 1: // jogador
                // criando o jogador antes de adicionar ao time
                $j = new Jogador(
                    readline("Nome: "),
                    (int)readline("Idade: "),
                    readline("Nacionalidade: "),
                    (float)readline("Altura: "),
                    (float)readline("Peso: "),
                    readline("Posição: "),
                    (int)readline("Número da camisa: "),
                    readline("Perna dominante: ")
                );

                $times[$timeNome]->contratarJogador($j); // adiciona jogador ao time
                echo "Jogador {$j->getNome()} contratado ao time {$times[$timeNome]->nome}. Bem-vindo!\n"; // mensagem confirmando a contratação
                break;

            case 2: // técnico
                $t = new Tecnico(
                readline("Nome: "),
                (int)readline("Idade: "),
                readline("Nacionalidade: "),
                (int)readline("Experiência (anos): "),
                (float)readline("Salário: ")
            );

            $times[$timeNome]->contratarTecnico($t); // adiciona técnico
            echo "Técnico {$t->getNome()} contratado ao time {$times[$timeNome]->nome}. Bem-vindo!\n"; 
            break;

            case 3: // médico
                $m = new Medico(
                readline("Nome: "),
                (int)readline("Idade: "),
                readline("Nacionalidade: "),
                readline("Especialidade: "),
                readline("CRM: "),
                (int)readline("Experiência (anos): ")
            );

            $times[$timeNome]->contratarMedico($m); // adiciona médico
            echo "Médico {$m->getNome()} adicionado ao time {$times[$timeNome]->nome}. Bem-vindo!\n";
            break;

        case 4: // add torcedor
                $tr = new Torcedor(
                readline("Nome: "),
                (int)readline("Idade: "),
                readline("Nacionalidade: "),
                readline("Fidelidade: "),
                readline("Tipo: ")
            );

            $times[$timeNome]->adicionarTorcedor($tr); // adiciona torcedor
            echo "Torcedor {$tr->getNome()} adicionado ao time {$times[$timeNome]->nome}. Bem-vindo!\n";
            break;

        default:
            echo "Opção inválida. Tente novamente!\n"; // caso o usuário digite algo errado
    }

        readline("\nDigite enter para voltar ao menu..."); // pausa antes de voltar
        break;
        case 5:
            limparTela();
            echo "=== Remover Pessoa de Time ===\n\n";

            if (empty($times)) { // se n tiver nada na array de times
                echo "Nenhum time cadastrado no sistema.\n";
                readline("Digite enter para voltar ao menu...");
                break;
            }

            echo "Times cadastrados:\n"; // auto explicativo
            foreach ($times as $t) echo "- {$t->nome}\n";

            $timeNome = strtoupper(readline("\nDigite o nome do time: "));
            if (!isset($times[$timeNome])) { // checa se o time ta cadastrado
                echo "Time não cadastrado!\n";
                readline("Digite enter para voltar ao menu...");
                break;
            }

            $t = $times[$timeNome];

            echo "\nElenco do {$t->nome}:\n\n";

            echo "Jogadores: ";
            if (empty($t->jogadores)) 
                echo "Nenhum\n";
            else { 
                foreach ($t->jogadores as $j) echo $j->getNome() . ", "; echo "\n";  // nome dos jogadores
            }

            echo "Médicos: ";
            if (empty($t->medicos)) 
                echo "Nenhum\n";
            else { 
                foreach ($t->medicos as $m) echo $m->getNome() . ", "; echo "\n"; // nome dos médicos
            }

            echo "Técnico: " . ($t->tecnico ? $t->tecnico->getNome() : "Nenhum") . "\n"; // técnico

            echo "Torcedores: ";
            if (empty($t->torcedores))
                 echo "Nenhum\n";
            else { 
                foreach ($t->torcedores as $tr) echo $tr->getNome() . ", "; echo "\n"; // torcedores
            }

            $tipo = (int)readline("\nEscolha o tipo de pessoa para remover: [1] Jogador [2] Médico [3] Torcedor [4] Técnico: ");
            $nomePessoa = strtoupper(readline("Nome da pessoa: "));

            switch ($tipo) {
                case 1:
                    $t->jogadores = array_filter($t->jogadores, fn($j)=>strtoupper($j->getNome()) !== $nomePessoa); // percorre a lista de jogadores, mantend só os que tem nome diferente, strtoupper ignora maiuscula/minuscula
                    break;
                case 2:
                    $t->medicos = array_filter($t->medicos, fn($m)=>strtoupper($m->getNome()) !== $nomePessoa); // mesma lógica
                    break;
                case 3:
                    $t->torcedores = array_filter($t->torcedores, fn($tr)=>strtoupper($tr->getNome()) !== $nomePessoa); // mesma lógica
                    break;
                case 4:
                    if ($t->tecnico && strtoupper($t->tecnico->getNome()) === $nomePessoa)
                        $t->tecnico = null;
                     // verifica se tem técnico e o nome bate, se for verdadeiro remove  técnico
                    else 
                    echo "Técnico não encontrado.\n";
                    break;
                default:
                    echo "Opção inválida.\n";
            }

            echo "Pessoa removida. Adeus!\n";
            readline("\nDigite enter para voltar ao menu...");
            break;   

        case 6: // Agendar partida
            limparTela();
            echo "=== Agendar Partida ===\n\n";

            echo "Times cadastrados:\n";
            foreach ($times as $t) echo "- {$t->nome}\n";


            if (count($times) < 2) {
                echo "É preciso ter 2 times no sistema para agendar uma partida!\n";
                readline("\nDigite enter para voltar ao menu...");
                break;
            }

            $t1 = strtoupper(readline("Time 1: "));
            $t2 = strtoupper(readline("Time 2: "));

            if (!isset($times[$t1]) || !isset($times[$t2])) {
                echo "Um dos times não existe.\n";
                readline("\nDigite enter para voltar ao menu...");
                break;
            }

            $local = readline("Local: "); // pergunta o local 
            $dataAgendada = readline("Data (dd/mm/AAAA): "); // data
            $dataPartida = DateTime::createFromFormat('d/m/Y', $dataAgendada); // converte pro formato dia mes ano
            $p = new Partida($dataPartida, $local, [$times[$t1], $times[$t2]]); // cria
            $partidas[] = $p;
            echo "Partida agendada!\n";
            readline("\nDigite enter para voltar ao menu...");
            break;

        case 7: // Listar as partidas agendadas
            limparTela();
            echo "=== Partidas Agendadas ===\n\n";
            if (empty($partidas)) {
                echo "Nenhuma partida agendada.\n";
            } else {
                foreach ($partidas as $p) {
                    echo "- {$p->times[0]->nome} x {$p->times[1]->nome} em {$p->data->format('d/m/Y')} — {$p->local}\n";
                }
            }
            readline("\nDigite enter para voltar ao menu...");
            break;

        case 8: // Informações do time
            limparTela();
            echo "=== Informações do Time ===\n\n";

            if (empty($times)){
                echo "Nenhum time cadastrado no sistema. \n\n";
                readline("\nDigite enter para voltar ao menu...");
                break;
            }

            echo "Times cadastrados: \n\n";
            foreach ($times as $t) echo "- " . $t->nome . "\n"; // percorre os times cadastrados

            $nome = strtoupper(readline("\nDigite o nome do time para ver suas informações:")); // converte o readline pra caixa alta pra evitar erros

            $timeCadastrado = false;
            foreach ($times as $t) {
                if (strtoupper($t->nome) === $nome){
                    limparTela();
                    echo "=== Informações de {$t->nome} === \n\n";
                    echo $t->info() . "\n";
                    $timeCadastrado = true;
                    break;
                }
            }

            if (!$timeCadastrado){
                echo "Time não cadastrado! \n";
            }

            readline("\nDigite enter para voltar ao menu...");
            break;

        default:
            echo "Opção inválida. Digite enter para continuar.\n";
            readline();
            break;
    }
}


// ficou meio extenso, talvez desse pra economizar linhas com mais algumas funções, mas é isso