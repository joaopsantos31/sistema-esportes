<?php
declare(strict_types=1);
namespace SistemaEsportes\Classes;

class Medico extends Pessoa { // subclasse de pessoa
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        protected string $especialidade, 
        protected string $crm,
        protected int $anosExperiencia
    ) {
        parent::__construct($nome, $idade, $nacionalidade); // construtor herdado
    }
    
    public function getEspecialidade(): string { 
        return $this->especialidade;
     }
    public function getCrm(): string { 
        return $this->crm; 
    }
    public function getAnosExperiencia(): int { 
        return $this->anosExperiencia; 
    }
    
    public function descrever(): string {
        return "Médico {$this->getNome()}, {$this->idade} anos, especialidade em {$this->especialidade}, CRM: {$this->crm}";
    }
}