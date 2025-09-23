<?php
declare(strict_types=1); // explicação no index

namespace SistemaEsportes\Classes;

class Time {
    public array $jogadores = []; // array para armanezar jogadores
    public array $medicos = []; // array para armanezar medicos
    public array $torcedores = []; // array para armanezar torcedores
    public ?Tecnico $tecnico = null; // variável para técnico, nulo como padrão 

    public string $nome;
    public string $regiao;
    public \DateTimeInterface $fundacao; 
    public string $estadio = ''; // opcional (flamengo...)
    public array $titulos = [];
    public string $serie = '';
    public array $patrocinadores = [];

    public function __construct(
        string $nome,
        string $regiao,
        \DateTimeInterface $fundacao,
        string $estadio = '', // valor padrão vazio
        array $titulos = [], //mesmo caso
        string $serie = '', // mesmo caso
        array $patrocinadores = [] // mesmo caso
    ) {
        $this->nome = $nome;
        $this->regiao = $regiao;
        $this->fundacao = $fundacao;
        $this->estadio = $estadio;
        $this->titulos = $titulos;
        $this->serie = $serie;
        $this->patrocinadores = $patrocinadores;
    }

    public function contratarJogador(Jogador $j): void { // add jogadores ao time
        $this->jogadores[] = $j;
    }

    public function contratarTecnico(Tecnico $t): void { // add um tecnico ao time 
        $this->tecnico = $t;
    }

    public function contratarMedico(Medico $m): void { // add um medico ao time
        $this->medicos[] = $m;
    }

    public function adicionarTorcedor(Torcedor $t): void { // add um torcedor ao time
        $this->torcedores[] = $t; // [] add ao fim da array
    }


    public function info(): string { // função pra retornar as informações
        $tecnicoNome = $this->tecnico ? $this->tecnico->getNome() : "Sem técnico"; // verifica se tem ou n tecnico

        // Jogadores
        $listaJogadores = "Nenhum";
        if (!empty($this->jogadores)) { // SE não estiver vazio a array de jogadores do time
            $nomes = "";
            foreach ($this->jogadores as $j) {
                $nomes .= $j->getNome() . ", "; // percorre os jogadores, getnome pra aparecer o nome
            }
            $listaJogadores = rtrim($nomes, ", "); // rtrim tira a virgula extra no final
        }

        // Médicos
        $listaMedicos = "Nenhum";
        if (!empty($this->medicos)) {
            $nomes = "";
            foreach ($this->medicos as $m) {
                $nomes .= $m->getNome() . ", ";
            }
            $listaMedicos = rtrim($nomes, ", ");
        }

        // Torcedores
        $listaTorcedores = "Nenhum";
        if (!empty($this->torcedores)) {
            $nomes = "";
            foreach ($this->torcedores as $t) {
                $nomes .= $t->getNome() . ", ";
            }
            $listaTorcedores = rtrim($nomes, ", ");
        }

        return "====== INFORMAÇÕES DO TIME ======\n\n"
             . "Nome: {$this->nome}\n"
             . "Estádio: " . ($this->estadio !== '' ? $this->estadio : "Sem estádio.") . "\n" // caso estado NÃO estiver vazio, mostra o nome, se não, mostra estádio
             . "Região: {$this->regiao}\n"
             . "Fundação: " . $this->fundacao->format("d/m/Y") . "\n" // data no padrão dia mes ano
             . "Técnico: {$tecnicoNome}\n"
             . "Jogadores (" . count($this->jogadores) . "): {$listaJogadores}\n" // contagem de jogadores
             . "Médicos (" . count($this->medicos) . "): {$listaMedicos}\n" // mesma lógica
             . "Torcedores (" . count($this->torcedores) . "): {$listaTorcedores}\n"; // mesma lógica
             // o . concatena a string, ou seja, retorna tudo em uma unica string
    }
    }