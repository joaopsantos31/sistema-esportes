<?php
declare(strict_types=1); // explicação no index

namespace SistemaEsportes\Classes;

class Time {
    public array $jogadores = []; // array para armanezar jogadores
    public array $medicos = []; // array para armanezar medicos
    public array $torcedores = []; // array para armanezar torcedores
    public ?Tecnico $tecnico = null; // variável para técnico 

    public string $nome;
    public string $regiao;
    public \DateTimeImmutable $fundacao; 
    public string $estadio = ''; // opcional (flamengo...)
    public array $titulos = [];
    public string $serie = '';
    public array $patrocinadores = [];

    public function __construct(
        string $nome,
        string $regiao,
        \DateTimeImmutable $fundacao,
        string $estadio = '',
        array $titulos = [],
        string $serie = '',
        array $patrocinadores = []
    ) {
        $this->nome = $nome;
        $this->regiao = $regiao;
        $this->fundacao = $fundacao;
        $this->estadio = $estadio;
        $this->titulos = $titulos;
        $this->serie = $serie;
        $this->patrocinadores = $patrocinadores;
    }

    public function adicionarJogador(Jogador $j): void {
        $this->jogadores[] = $j;
    }

    public function contratarTecnico(Tecnico $t): void {
        $this->tecnico = $t;
    }

    public function adicionarMedico(Medico $m): void {
        $this->medicos[] = $m;
    }

    public function adicionarTorcedor(Torcedor $t): void {
        $this->torcedores[] = $t;
    }

    public function escalar(): string {
        $texto = "Escalação de {$this->nome}: ";
        if (empty($this->jogadores)) {
            $texto .= "Sem jogadores cadastrados";
        } else {
            $contador = 0;
            foreach ($this->jogadores as $jogador) {
                $texto .= $jogador->getNome();
                $contador++;
                if ($contador >= 11) {
                    break;
                }
                $texto .= ", ";
            }
        }
        return $texto;
    }

    public function competir(): string {
        return "{$this->nome} está competindo!";
    }

    public function info(): string {
        $tecnicoNome = $this->tecnico ? $this->tecnico->getNome() : "Sem técnico";

        // Jogadores
        $listaJogadores = "Nenhum";
        if (!empty($this->jogadores)) {
            $nomes = "";
            foreach ($this->jogadores as $j) {
                $nomes .= $j->getNome() . ", ";
            }
            $listaJogadores = rtrim($nomes, ", ");
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

        return "====== INFORMAÇÕES DO TIME ======\n"
             . "Nome: {$this->nome}\n"
             . "Estádio: " . ($this->estadio !== '' ? $this->estadio : "Não definido") . "\n"
             . "Região: {$this->regiao}\n"
             . "Fundação: " . $this->fundacao->format("d/m/Y") . "\n"
             . "Técnico: {$tecnicoNome}\n"
             . "Jogadores (" . count($this->jogadores) . "): {$listaJogadores}\n"
             . "Médicos (" . count($this->medicos) . "): {$listaMedicos}\n"
             . "Torcedores (" . count($this->torcedores) . "): {$listaTorcedores}\n";
    }
    }