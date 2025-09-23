<?php
declare(strict_types=1);

namespace SistemaEsportes\Classes;

class Torcedor extends Pessoa {
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        public string $fidelidade,
        public string $tipo // organizada, comum
    ) {
        parent::__construct($nome, $idade, $nacionalidade);
    }

    public function torcer(): string {
        return "{$this->getNome()} tá torcendo!"; // mesmo caso
    }
}
