<?php
declare(strict_types=1);

namespace SistemaEsportes\Classes;

class Medico extends Pessoa {
    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        public string $especialidade,
        public string $crm,
        public int $anosExperiencia
    ) {
        parent::__construct($nome, $idade, $nacionalidade);
    }

    public function tratarJogador(Jogador $j): string {
        return "Dr(a). {$this->getNome()} tratou o jogador {$j->getNome()}.";
    }
}
