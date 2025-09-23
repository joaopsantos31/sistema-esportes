<?php
declare(strict_types=1);

namespace SistemaEsportes\Classes;

class Partida {
   public function __construct(
    public \DateTimeInterface $data, // data da partida
    public string $local,
    public array $times, 
    public string $placar = "0x0" // placar inicial (quando tiver partida)
) {
    if (count($times) != 2) {
        throw new \InvalidArgumentException("Uma partida só pode ter dois times."); // n deixa ter mais de dois times
    }
}}