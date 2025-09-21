<?php

namespace SistemaEsportes\Classes;

class Tecnico extends Pessoa {
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        public int $experiencia,
        public float $salario,
        public string $planosJogo = ""
    ) {
        parent::__construct($nome, $idade, $nacionalidade);
    }

    public function escalarTime(Time $time): string {
        return "Técnico {$this->getNome()} escalou o time {$time->nome}.";
    }

    public function planejarJogo(): string { return "Planejando o jogo..."; }
    public function treinar(): string { return "Treinando a equipe..."; }
}
