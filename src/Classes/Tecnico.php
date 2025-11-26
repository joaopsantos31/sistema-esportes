<?php
declare(strict_types=1);
namespace SistemaEsportes\Classes;

class Tecnico extends Pessoa {
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        protected int $experiencia, 
        protected float $salario,
        protected string $planosJogo = ""
    ) {
        parent::__construct($nome, $idade, $nacionalidade);
    }
    
    public function getExperiencia(): int { 
        return $this->experiencia; 
    }
    public function getSalario(): float { 
        return $this->salario; 
    }
    public function getPlanosJogo(): string {
         return $this->planosJogo; 
        }
    
    public function descrever(): string {
        return "Técnico {$this->getNome()}, {$this->idade} anos, {$this->experiencia} anos de experiência";
    }
}