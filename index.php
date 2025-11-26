<?php 
declare(strict_types=1);

use SistemaEsportes\Classes\Pessoa;
use SistemaEsportes\Classes\Jogador;
use SistemaEsportes\Classes\Juiz;
use SistemaEsportes\Classes\Torcedor;
use SistemaEsportes\Classes\Time;
use SistemaEsportes\Classes\Partida;
use SistemaEsportes\Classes\Medico;
use SistemaEsportes\Classes\Tecnico;

require __DIR__ . '/vendor/autoload.php';

$partidas = []; // array vazia de partidas

function limparTela(): void {
    for ($contador = 0; $contador < 50; $contador++){
        echo "\n";
    }
}

// Real Madrid - time padrão
$realMadrid = new Time(
    'Real Madrid',
    'Madrid, Espanha',
    new DateTime('1902-03-06'),
    'Santiago Bernabéu'
);

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

// Barcelona - time padrão
$barcelona = new Time(
    'FC Barcelona',
    'Barcelona, Espanha',
    new DateTime('1899-11-29'),
    'Camp Nou'
);

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


$times = []; // array de times vazia
$times[$realMadrid->getIdentificador()] = $realMadrid; // adiciona os times com os identificadores
$times[$barcelona->getIdentificador()] = $barcelona; 

// Partida inicial
$partidaInicial = new Partida(
    new DateTime('2025-10-26'), 
    'Santiago Bernabéu',
    [$realMadrid, $barcelona]
);
$partidas[] = $partidaInicial;

function exibirMenu(): void
{
    limparTela();
    echo "\n======================\n";
    echo " FuteSystem 2.0\n";
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

while (true) {
    exibirMenu();

    echo "\nDigite a opção desejada: ";
    $entrada = trim(readline());

    if (strtoupper($entrada) === "Q") { 
        echo "Saindo do sistema. Até a próxima!!...\n"; 
        break;
    }

    $opcao = (int) $entrada;

    switch ($opcao) {
        case 1:
            limparTela();
            echo "=== Criar Time ===\n\n";

            echo "Times já cadastrados: \n\n";
            foreach ($times as $t) {
                echo "- {$t->getNome()}\n";
            }

            echo "\n";
            $nome = readline("Nome do time: ");
            // identificador sem espaços e em maiúscula
            $identificador = strtoupper(str_replace(' ', '', $nome));

            if (isset($times[$identificador])){ 
                echo "O time $nome já está cadastrado no sistema.\n";
                readline("\nDigite enter para voltar ao menu..");
                break;
            }

            $regiao = readline("Região do time (Cidade, País): ");
            $dataFund = readline("Data de fundação (dd/mm/AAAA): ");
            $fundacao = DateTime::createFromFormat('d/m/Y', $dataFund); 
            $estadio = readline("Estádio (opcional, deixe vazio se não tiver): "); 

            $novoTime = new Time($nome, $regiao, $fundacao, $estadio);
            $times[$novoTime->getIdentificador()] = $novoTime;
            echo "Time criado com sucesso!\n";
            readline("\nDigite enter para voltar ao menu...");
            break;

        case 2:
            limparTela();
            echo "=== Listar times ===\n\n";
            if (empty($times)) {
                echo "Nenhum time cadastrado no sistema.\n";
            } else {
                foreach ($times as $t) {
                    echo "- {$t->getNome()}\n";
                }
            }
            readline("\nPressione enter para voltar ao menu...");
            break;

        case 3:
            limparTela();
            echo "=== Excluir Time ===\n\n";
            foreach ($times as $t) {
                echo "- {$t->getNome()}\n";
            }

            echo "\n";
            $nome = readline("Nome do time que vai ser excluido: ");
            $identificador = strtoupper(str_replace(' ', '', $nome));

            if (isset($times[$identificador])) {
                unset($times[$identificador]);
                echo "Time removido. Adeus!\n"; 
            } else {
                echo "Time não encontrado no sistema.\n"; 
            }

            readline("\nDigite enter para voltar ao menu...");
            break;

        case 4:
            limparTela();
            echo "=== Adicionar pessoa em time ===\n\n";

            if (empty($times)) {
                echo "Nenhum time cadastrado no sistema.\n";
                readline("\nDigite enter para voltar ao menu...");
                break;
            }

            echo "Times cadastrados no sistema:\n\n";
            foreach ($times as $t) {
                echo "- {$t->getNome()}\n";
            }

            echo "\n";
            $timeNome = readline("Nome do time: ");
            $identificador = strtoupper(str_replace(' ', '', $timeNome));

            if (!isset($times[$identificador])) {
                echo "O time não existe.\n"; 
                readline("\nDigite enter para voltar ao menu...");
                break;
            }

            echo "\nDigite o número da sua escolha: ";
            echo "\n[1] Jogador | [2] Técnico | [3] Médico | [4] Torcedor: ";
            $tipo = (int)readline();

            switch ($tipo) {
                case 1:
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

                    $times[$identificador]->contratarJogador($j);
                    echo "Jogador {$j->getNome()} contratado ao time {$times[$identificador]->getNome()}. Bem-vindo!\n";
                    break;

                case 2:
                    $t = new Tecnico(
                        readline("Nome: "),
                        (int)readline("Idade: "),
                        readline("Nacionalidade: "),
                        (int)readline("Experiência (anos): "),
                        (float)readline("Salário: ")
                    );

                    $times[$identificador]->contratarTecnico($t);
                    echo "Técnico {$t->getNome()} contratado ao time {$times[$identificador]->getNome()}. Bem-vindo!\n"; 
                    break;

                case 3:
                    $m = new Medico(
                        readline("Nome: "),
                        (int)readline("Idade: "),
                        readline("Nacionalidade: "),
                        readline("Especialidade: "),
                        readline("CRM: "),
                        (int)readline("Experiência (anos): ")
                    );

                    $times[$identificador]->contratarMedico($m);
                    echo "Médico {$m->getNome()} adicionado ao time {$times[$identificador]->getNome()}. Bem-vindo!\n";
                    break;

                case 4:
                    $tr = new Torcedor(
                        readline("Nome: "),
                        (int)readline("Idade: "),
                        readline("Nacionalidade: "),
                        readline("Fidelidade: "),
                        readline("Tipo: ")
                    );

                    $times[$identificador]->adicionarTorcedor($tr);
                    echo "Torcedor {$tr->getNome()} adicionado ao time {$times[$identificador]->getNome()}. Bem-vindo!\n";
                    break;

                default:
                    echo "Opção inválida. Tente novamente!\n";
            }

            readline("\nDigite enter para voltar ao menu...");
            break;

        case 5:
            limparTela();
            echo "=== Remover Pessoa de Time ===\n\n";

            if (empty($times)) {
                echo "Nenhum time cadastrado no sistema.\n";
                readline("Digite enter para voltar ao menu...");
                break;
            }

            echo "Times cadastrados:\n";
            foreach ($times as $t) echo "- {$t->getNome()}\n";

            $timeNome = readline("\nDigite o nome do time: ");
            $identificador = strtoupper(str_replace(' ', '', $timeNome));
            
            if (!isset($times[$identificador])) {
                echo "Time não cadastrado!\n";
                readline("Digite enter para voltar ao menu...");
                break;
            }

            $t = $times[$identificador];

            echo "\nElenco do {$t->getNome()}:\n\n";

            echo "Jogadores: ";
            if (empty($t->getJogadores())) 
                echo "Nenhum\n";
            else { 
                foreach ($t->getJogadores() as $j) echo $j->getNome() . ", ";
                echo "\n";
            }

            echo "Médicos: ";
            if (empty($t->getMedicos())) 
                echo "Nenhum\n";
            else { 
                foreach ($t->getMedicos() as $m) echo $m->getNome() . ", ";
                echo "\n";
            }

            echo "Técnico: " . ($t->getTecnico() ? $t->getTecnico()->getNome() : "Nenhum") . "\n";

            echo "Torcedores: ";
            if (empty($t->getTorcedores()))
                echo "Nenhum\n";
            else { 
                foreach ($t->getTorcedores() as $tr) echo $tr->getNome() . ", ";
                echo "\n";
            }

            $tipo = (int)readline("\nEscolha o tipo de pessoa para remover: [1] Jogador [2] Médico [3] Torcedor [4] Técnico: ");
            $nomePessoa = readline("Nome da pessoa: ");

            $removido = false;
            switch ($tipo) {
                case 1:
                    $removido = $t->removerJogador($nomePessoa);
                    break;
                case 2:
                    $removido = $t->removerMedico($nomePessoa);
                    break;
                case 3:
                    $removido = $t->removerTorcedor($nomePessoa);
                    break;
                case 4:
                    $removido = $t->removerTecnico();
                    break;
                default:
                    echo "Opção inválida.\n";
            }

            if ($removido) {
                echo "Pessoa removida. Adeus!\n";
            } else {
                echo "Pessoa não encontrada.\n";
            }
            
            readline("\nDigite enter para voltar ao menu...");
            break;   

        case 6:
            limparTela();
            echo "=== Agendar Partida ===\n\n";

            echo "Times cadastrados:\n";
            foreach ($times as $t) {
                echo "- {$t->getNome()}\n";
            }

            if (count($times) < 2) {
                echo "É preciso ter 2 times no sistema para agendar uma partida!\n";
                readline("\nDigite enter para voltar ao menu...");
                break;
            }

            $t1Nome = readline("Time 1: ");
            $t2Nome = readline("Time 2: ");
            
            $id1 = strtoupper(str_replace(' ', '', $t1Nome));
            $id2 = strtoupper(str_replace(' ', '', $t2Nome));

            if (!isset($times[$id1]) || !isset($times[$id2])) {
                echo "Um dos times não existe.\n";
                readline("\nDigite enter para voltar ao menu...");
                break;
            }

            $local = readline("Local: ");
            $dataAgendada = readline("Data (dd/mm/AAAA): ");
            $dataPartida = DateTime::createFromFormat('d/m/Y', $dataAgendada);
            
            // Pergunta se a partida já foi realizada
            $foiRealizada = strtoupper(readline("A partida já foi realizada? (S/N): "));
            
            $p = new Partida($dataPartida, $local, [$times[$id1], $times[$id2]]);
            
            // Se foi realizada, pede o placar
            if ($foiRealizada === 'S') {
                $golsTime1 = (int)readline("Gols do {$times[$id1]->getNome()}: ");
                $golsTime2 = (int)readline("Gols do {$times[$id2]->getNome()}: ");
                $p->atualizarPlacar($golsTime1, $golsTime2);
            }
            
            $partidas[] = $p;
            echo "Partida agendada!\n";
            readline("\nDigite enter para voltar ao menu...");
            break;

        case 7:
            limparTela();
            echo "=== Partidas Agendadas ===\n\n";
            if (empty($partidas)) {
                echo "Nenhuma partida agendada.\n";
            } else {
                foreach ($partidas as $p) {
                    $timesPartida = $p->getTimes();
                    $status = $p->foiRealizada() ? "✓ Realizada" : "○ Agendada";
                    echo "- {$timesPartida[0]->getNome()} x {$timesPartida[1]->getNome()} ";
                    echo "({$p->getPlacarFormatado()}) ";
                    echo "em {$p->getData()->format('d/m/Y')} — {$p->getLocal()} ";
                    echo "[{$status}]\n";
                }
            }
            readline("\nDigite enter para voltar ao menu...");
            break;

        case 8:
            limparTela();
            echo "=== Informações do Time ===\n\n";

            if (empty($times)){
                echo "Nenhum time cadastrado no sistema. \n\n";
                readline("\nDigite enter para voltar ao menu...");
                break;
            }

            echo "Times cadastrados: \n\n";
            foreach ($times as $t) echo "- " . $t->getNome() . "\n";

            $nome = readline("\nDigite o nome do time para ver suas informações:");
            $identificador = strtoupper(str_replace(' ', '', $nome));

            if (isset($times[$identificador])) {
                limparTela();
                echo "=== Informações de {$times[$identificador]->getNome()} === \n\n";
                echo $times[$identificador]->info() . "\n";
            } else {
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