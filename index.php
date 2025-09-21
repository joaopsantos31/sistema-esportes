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
use SistemaEsportes\Classes\Medico;
use SistemaEsportes\Classes\Tecnico;

require __DIR__ . '/vendor/autoload.php'; // para carregar as classes do projeto

$times = [];
$partidas = [];

function exibirMenu(): void
{
    echo "\n======================\n";
    echo " FuteSystem\n";
    echo "======================\n\n";

    echo "1 - Criar Time\n";
    echo "2 - Listar Times\n";
    echo "3 - Excluir Time\n";
    echo "4 - Adicionar Pessoa em Time\n";
    echo "5 - Remover Pessoa de Time\n";
    echo "6 - Criar Partida\n";
    echo "7 - Listar Partidas\n";
    echo "8 - Ver informações de um Time\n";
    echo "q - Sair\n";
}

while (true) {
    exibirMenu();

    echo "\nDigite a opção desejada: ";
    $opcaoBruta = readline();

    if (strtolower(trim($opcaoBruta)) === "q") {
        echo "Saindo...\n";
        break;
    }

    $opcao = (int) $opcaoBruta;

    switch ($opcao) {
        case 1: // Criar Time
            $nome = readline("Nome do time: ");
            $regiao = readline("Região: ");
            $dataTexto = readline("Data de fundação (dd/mm/YYYY): ");
            // Converte para o formato aceito pelo PHP (YYYY-mm-dd)
            $dia = substr($dataTexto, 0, 2);
            $mes = substr($dataTexto, 3, 2);
            $ano = substr($dataTexto, 6, 4);
            $fundacao = new DateTimeImmutable("$ano-$mes-$dia");

            $estadio = readline("Estádio (opcional, deixe vazio se não tiver): ");
            $times[$nome] = new Time($nome, $regiao, $fundacao, $estadio);
            echo "Time $nome criado!\n";
            break;

        case 2: // Listar Times
            if (empty($times)) {
                echo "Nenhum time cadastrado.\n";
            } else {
                foreach ($times as $t) {
                    echo "- {$t->nome}\n";
                }
            }
            break;

        case 3: // Excluir Times
            $nome = readline("Nome do time a excluir: ");
            if (isset($times[$nome])) {
                unset($times[$nome]);
                echo "Time removido.\n";
            } else {
                echo "Time não encontrado.\n";
            }
            break;

        case 4: // Adicionar Pessoas (técnico, jogadores, etc) em Times
            $timeNome = readline("Nome do time: ");
            if (!isset($times[$timeNome])) {
                echo "Time não existe.\n";
                break;
            }
            echo "1 - Jogador, 2 - Técnico, 3 - Médico, 4 - Torcedor: ";
            $tipo = readline();
            switch ($tipo) {
                case "1":
                    $j = new Jogador(
                        readline("Nome: "),
                        readline("Idade: "),
                        readline("Nacionalidade: "),
                        readline("Altura: "),
                        readline("Peso: "),
                        readline("Posição: "),
                        readline("Número camisa: "),
                        readline("Perna dominante: ")
                    );
                    $times[$timeNome]->adicionarJogador($j);
                    echo "Jogador adicionado ao time.\n";
                    break;
                case "2":
                    $t = new Tecnico(
                        readline("Nome: "),
                        readline("Idade: "),
                        readline("Nacionalidade: "),
                        readline("Experiência (anos): "),
                        readline("Salário: ")
                    );
                    $times[$timeNome]->contratarTecnico($t);
                    echo "Técnico contratado.\n";
                    break;
                case "3":
                    $m = new Medico(
                        readline("Nome: "),
                        readline("Idade: "),
                        readline("Nacionalidade: "),
                        readline("Especialidade: "),
                        readline("CRM: "),
                        readline("Anos exp.: ")
                    );
                    $times[$timeNome]->adicionarMedico($m);
                    echo "Médico adicionado.\n";
                    break;
                case "4":
                    $tor = new Torcedor(
                        readline("Nome: "),
                        readline("Idade: "),
                        readline("Nacionalidade: "),
                        readline("Fidelidade: "),
                        readline("Tipo: ")
                    );
                    $times[$timeNome]->adicionarTorcedor($tor);
                    echo "Torcedor adicionado.\n";
                    break;
                default:
                    echo "Tipo inválido.\n";
            }
            break;

        case 5: // Remover Pessoa de Time
            $timeNome = readline("Nome do time: ");
            if (!isset($times[$timeNome])) { echo "Time não existe.\n"; break; }
            echo "1 - Jogador, 2 - Médico, 3 - Torcedor, 4 - Técnico: ";
            $tipo = readline();
            $nome = readline("Nome da pessoa: ");
            $time = $times[$timeNome];
            switch ($tipo) {
                case "1":
                    $time->jogadores = array_filter($time->jogadores, fn($j) => $j->getNome() !== $nome);
                    echo "Jogador removido.\n";
                    break;
                case "2":
                    $time->medicos = array_filter($time->medicos, fn($m) => $m->getNome() !== $nome);
                    echo "Médico removido.\n";
                    break;
                case "3":
                    $time->torcedores = array_filter($time->torcedores, fn($t) => $t->getNome() !== $nome);
                    echo "Torcedor removido.\n";
                    break;
                case "4":
                    $time->tecnico = null;
                    echo "Técnico removido.\n";
                    break;
                default:
                    echo "Tipo inválido.\n";
            }
            break;

        case 6: // Criar Partida
            if (count($times) < 2) {
                echo "É preciso pelo menos 2 times cadastrados.\n";
                break;
            }
            $t1 = readline("Time 1: ");
            $t2 = readline("Time 2: ");
            if (!isset($times[$t1]) || !isset($times[$t2])) {
                echo "Um dos times não existe.\n";
                break;
            }
            $local = readline("Local: ");
            $dataTexto = readline("Data (dd/mm/YYYY): ");
            $dia = substr($dataTexto, 0, 2);
            $mes = substr($dataTexto, 3, 2);
            $ano = substr($dataTexto, 6, 4);
            $data = new DateTimeImmutable("$ano-$mes-$dia");

            $p = new Partida($data, $local, [$times[$t1], $times[$t2]]);
            $partidas[] = $p;
            echo "Partida criada!\n";
            break;

        case 7: // Listar Partidas
            if (empty($partidas)) {
                echo "Nenhuma partida cadastrada.\n";
            } else {
                foreach ($partidas as $p) {
                    echo "- {$p->local} em {$p->data->format('d/m/Y')} entre {$p->times[0]->nome} e {$p->times[1]->nome}\n";
                }
            }
            break;

        case 8: // Info do Time
            $nome = readline("Nome do time: ");
            if (isset($times[$nome])) {
                echo $times[$nome]->info() . "\n";
            } else {
                echo "Time não encontrado.\n";
            }
            break;

        default:
            echo "Opção inválida. Tecle ENTER para continuar.\n";
            readline();
            break;
    }
}