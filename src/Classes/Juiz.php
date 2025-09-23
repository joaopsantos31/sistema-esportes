<?php
declare(strict_types=1);

namespace SistemaEsportes\Classes;

class Juiz extends Pessoa { // subclasse de pessoa
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        public string $nivelArbitragem,
        public bool $var = true // aqui n tem  roubo
    ) {
        parent::__construct($nome, $idade, $nacionalidade); // herda de pessoa
    }

    public function apitarJogo(): string { return "Juiz {$this->getNome()} apitou a partida."; } // pro futuro quando tiverem partidas de vdd
}
