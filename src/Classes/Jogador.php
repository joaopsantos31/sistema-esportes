<?php
declare(strict_types=1);
namespace SistemaEsportes\Classes;

class Jogador extends Pessoa { // herda de pessoa
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        protected float $altura, // encapsulamento - atributos privados
        protected float $peso,
        protected string $posicao, 
        protected int $numeroCamisa,
        protected string $pernaDominante,
        protected int $gols = 0,
        protected int $assistencias = 0,
        protected string $carreira = ""
    ) {
        parent::__construct($nome, $idade, $nacionalidade); // construtor herdado de pessoa
    }
    
    public function getAltura(): float { 
        return $this->altura; 
    }
    public function getPeso(): float { 
        return $this->peso;
     }
    public function getPosicao(): string { 
        return $this->posicao;
     }
    public function getNumeroCamisa(): int { 
        return $this->numeroCamisa; 
    }
    public function getPernaDominante(): string { 
        return $this->pernaDominante; 
    }
    public function getGols(): int { 
        return $this->gols; 
    }
    public function getAssistencias(): int {
        return $this->assistencias; 
    }
    public function getCarreira(): string {
         return $this->carreira;
         }
    
    public function mostrarPosicao(): string {
        return "{$this->getNome()} está jogando de {$this->posicao}."; 
    }
    

    public function descrever(): string {
        return "Nome: {$this->getNome()}, camisa #{$this->getNumeroCamisa()}, perna dominante {$this->getPernaDominante()}, posição {$this->getPosicao()}";
    }
}