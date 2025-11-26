<?php
declare(strict_types=1);
namespace SistemaEsportes\Classes;

class Time {
    protected array $jogadores = []; 
    protected array $medicos = [];
    protected array $torcedores = [];
    protected ?Tecnico $tecnico = null;
    protected string $nome;
    protected string $identificador; 
    protected string $regiao;
    protected \DateTimeInterface $fundacao; 
    protected string $estadio = '';
    protected array $titulos = [];
    protected string $serie = '';
    protected array $patrocinadores = [];
    
    public function __construct(
        string $nome,
        string $regiao,
        \DateTimeInterface $fundacao,
        string $estadio = '',
        array $titulos = [],
        string $serie = '',
        array $patrocinadores = []
    ) {
        $this->nome = $nome;
        $nomeNormalizado = str_replace(' ', '', $nome);
        $this->identificador = strtoupper($nomeNormalizado);
        $this->regiao = $regiao;
        $this->fundacao = $fundacao;
        $this->estadio = $estadio;
        $this->titulos = $titulos;
        $this->serie = $serie;
        $this->patrocinadores = $patrocinadores;
    }
    
    public function getNome(): string { return $this->nome; }
    public function getIdentificador(): string { return $this->identificador; }
    public function getRegiao(): string { return $this->regiao; }
    public function getFundacao(): \DateTimeInterface { return $this->fundacao; }
    public function getEstadio(): string { return $this->estadio; }
    public function getTitulos(): array { return $this->titulos; }
    public function getSerie(): string { return $this->serie; }
    public function getPatrocinadores(): array { return $this->patrocinadores; }
    public function getJogadores(): array { return $this->jogadores; }
    public function getMedicos(): array { return $this->medicos; }
    public function getTorcedores(): array { return $this->torcedores; }
    public function getTecnico(): ?Tecnico { return $this->tecnico; }
    
    public function contratarJogador(Jogador $j): void {
        $this->jogadores[] = $j;
    }
    
    public function contratarTecnico(Tecnico $t): void {
        $this->tecnico = $t;
    }
    
    public function contratarMedico(Medico $m): void {
        $this->medicos[] = $m;
    }
    
    public function adicionarTorcedor(Torcedor $t): void {
        $this->torcedores[] = $t;
    }
    
    public function removerJogador(string $nome): bool {
        foreach ($this->jogadores as $indice => $j) {
            if (strtoupper($j->getNome()) === strtoupper($nome)) {
                unset($this->jogadores[$indice]);
                $this->jogadores = array_values($this->jogadores); // reindexar array
                return true;
            }
        }
        return false;
    }
    

    public function removerMedico(string $nome): bool {
        foreach ($this->medicos as $indice => $m) {
            if (strtoupper($m->getNome()) === strtoupper($nome)) {
                unset($this->medicos[$indice]);
                $this->medicos = array_values($this->medicos);
                return true;
            }
        }
        return false;
    }
    
    public function removerTorcedor(string $nome): bool {
        foreach ($this->torcedores as $indice => $t) {
            if (strtoupper($t->getNome()) === strtoupper($nome)) {
                unset($this->torcedores[$indice]);
                $this->torcedores = array_values($this->torcedores);
                return true;
            }
        }
        return false;
    }
    
    public function removerTecnico(): bool {
        if ($this->tecnico !== null) {
            $this->tecnico = null;
            return true;
        }
        return false;
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
        
        return "====== INFORMAÇÕES DO TIME ======\n\n"
             . "Nome: {$this->nome}\n"
             . "Identificador: {$this->identificador}\n"
             . "Estádio: " . ($this->estadio !== '' ? $this->estadio : "Sem estádio.") . "\n"
             . "Região: {$this->regiao}\n"
             . "Fundação: " . $this->fundacao->format("d/m/Y") . "\n"
             . "Técnico: {$tecnicoNome}\n"
             . "Jogadores (" . count($this->jogadores) . "): {$listaJogadores}\n"
             . "Médicos (" . count($this->medicos) . "): {$listaMedicos}\n"
             . "Torcedores (" . count($this->torcedores) . "): {$listaTorcedores}\n";
    }
}