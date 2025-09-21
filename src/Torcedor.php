<?php
declare(strict_types=1);

namespace SistemaEsportes\Classes;

class Torcedor extends Pessoa {
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        public string $fidelidade,
        public string $tipo
    ) {
        parent::__construct($nome, $idade, $nacionalidade);
    }

    public function torcer(): string {
        return "{$this->getNome()} está torcendo!";
    }
}
