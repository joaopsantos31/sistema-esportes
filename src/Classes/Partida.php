<?php
declare(strict_types=1);
namespace SistemaEsportes\Classes;

class Partida {
    protected \DateTimeInterface $data; 
    protected string $local;
    protected array $times; 
    protected array $placar;
    protected bool $foiRealizada;
    
    public function __construct(
        \DateTimeInterface $data, 
        string $local, 
        array $times
    ) {
        if (count($times) !== 2) {
            throw new \InvalidArgumentException("Uma partida só pode ter dois times.");
        }
        
        $this->data = $data;
        $this->local = $local;
        $this->times = $times;
        $this->placar = [
            'timeA' => 0,
            'timeB' => 0
        ];
        $this->foiRealizada = false;
    }
    
    public function getData(): \DateTimeInterface {
        return $this->data;
    }
    
    public function getLocal(): string {
        return $this->local;
    }
    
    public function getTimes(): array {
        return $this->times;
    }
    
    public function getPlacar(): array {
        return $this->placar;
    }
    
    public function getPlacarFormatado(): string {
        return $this->placar['timeA'] . "x" . $this->placar['timeB'];
    }
    
    public function foiRealizada(): bool {
        return $this->foiRealizada;
    }
    

    public function atualizarPlacar(int $golsTimeA, int $golsTimeB): void {
        if ($golsTimeA < 0 || $golsTimeB < 0) {
            throw new \InvalidArgumentException("Gols não podem ser negativos.");
        }
        
        $this->placar['timeA'] = $golsTimeA;
        $this->placar['timeB'] = $golsTimeB;
        $this->foiRealizada = true;
    }
    
    public function marcarRealizada(): void {
        $this->foiRealizada = true;
    }
    

  
}