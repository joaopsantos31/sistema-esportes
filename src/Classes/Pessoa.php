<?php

declare(strict_types=1);

namespace SistemaEsportes\Classes;

abstract class Pessoa { // abstração de classe (sem instância, molde das subclasses - jogador, tecnico, etc)

    public function __construct(
        protected string $nome,
        protected int $idade,
        protected string $nacionalidade
    ) {}
    
    public function getNome(): string { return $this->nome; }
    public function getIdade(): int { return $this->idade; }
    public function getNacionalidade(): string { return $this->nacionalidade; }
    
    abstract public function descrever(): string;
}