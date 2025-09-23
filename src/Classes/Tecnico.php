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

}
