<?php
declare(strict_types=1); // explicação no index

namespace SistemaEsportes\Classes;

class Jogador extends Pessoa { // herda de pessoa
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        public float $altura,
        public float $peso,
        public string $posicao, 
        public int $numeroCamisa,
        public string $pernaDominante,
        public int $gols = 0,
        public int $assistencias = 0,
        public string $carreira = ""
    ) {
        parent::__construct($nome, $idade, $nacionalidade); // construto herdado de pessoa
    }

    public function mostrarPosicao(): string {
        return "{$this->getNome()} está jogando de {$this->posicao}."; 
    } 
}
