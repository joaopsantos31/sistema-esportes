<?php

namespace SistemaEsportes\Classes;

class Partida {
    public function __construct(
        public \DateTimeImmutable $data,
        public string $local,
        /** @var Time[] tamanho 2 */
        public array $times,
        public string $placar = "0x0"
    ) {}

    public function iniciar(): string { return "Partida iniciada em {$this->local}."; }
    public function finalizar(string $placar): string {
        $this->placar = $placar;
        return "Partida finalizada: {$placar}.";
    }
    public function registrarGol(Jogador $autor): string {
        return "Gol de {$autor->getNome()}!";
    }
}
