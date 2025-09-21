<?php
declare(strict_types=1);

namespace SistemaEsportes\Classes;

class Juiz extends Pessoa {
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        public string $nivelArbitragem,
        public bool $var = true
    ) {
        parent::__construct($nome, $idade, $nacionalidade); // herda de pessoa
    }

    public function apitarJogo(): string { return "Juiz {$this->getNome()} apitou a partida."; }
    public function usarVar(): string { return $this->var ? "VAR acionado" : "VAR indisponível"; }
}
