<?php
declare(strict_types=1);
namespace SistemaEsportes\Classes;

class Torcedor extends Pessoa {
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        protected string $fidelidade, 
        protected string $tipo // organizada, comum
    ) {
        parent::__construct($nome, $idade, $nacionalidade);
    }
    
    public function getFidelidade(): string { return $this->fidelidade; }
    public function getTipo(): string { return $this->tipo; }

    public function descrever(): string {
        return "Torcedor {$this->getNome()}, {$this->idade} anos, tipo: {$this->tipo}, fidelidade: {$this->fidelidade}";
    }
}