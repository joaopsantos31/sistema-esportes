<?php
declare(strict_types=1);
namespace SistemaEsportes\Classes;

class Juiz extends Pessoa { // subclasse de pessoa
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        protected string $nivelArbitragem, 
        protected bool $var = true // aqui n tem roubo
    ) {
        parent::__construct($nome, $idade, $nacionalidade); // herda de pessoa
    }
    
    public function getNivelArbitragem(): string { return $this->nivelArbitragem; }
    public function temVar(): bool {
         return $this->var; 
        }
    
    public function descrever(): string {
        $varTexto = $this->var ? "com VAR" : "sem VAR";
        return "Juiz {$this->getNome()}, {$this->idade} anos, nível {$this->nivelArbitragem} ({$varTexto})";
    }
}