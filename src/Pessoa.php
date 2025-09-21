<?php
declare(strict_types=1);

namespace SistemaEsportes\Classes;

abstract class Pessoa { // abtsração de classe (sem instância, molde de jogador, juiz, etc)
    public function __construct(
        protected string $nome,
        protected int $idade,
        protected string $nacionalidade
    ) {}

    public function getNome(): string { return $this->nome; }
    public function getIdade(): int { return $this->idade; } // acessando os métodos protegidos via getters
    public function getNacionalidade(): string { return $this->nacionalidade; } 
}
