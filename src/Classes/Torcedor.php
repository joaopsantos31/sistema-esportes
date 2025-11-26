<?php
declare(strict_types=1);
namespace SistemaEsportes\Classes;

class Torcedor extends Pessoa
{
    // ✅ CORREÇÃO PHP 7: Sem type hints nas propriedades
    // ✅ CORREÇÃO: Usando array para agrupar dados do torcedor
    protected $dadosTorcedor;

    public function __construct(
        string $nome,
        int $idade,
        string $nacionalidade,
        string $fidelidade,
        string $tipo
    ) {
        parent::__construct($nome, $idade, $nacionalidade);

        // ✅ ARRAY: Agrupa dados relacionados
        $this->dadosTorcedor = [
            'fidelidade' => '',
            'tipo' => ''
        ];

        $this->setFidelidade($fidelidade);
        $this->setTipo($tipo);
    }

    // ✅ POLIMORFISMO: Implementação obrigatória do método abstrato
    public function exibirInformacoes(): string
    {
        return "Torcedor: {$this->nome} | " .
               "Idade: {$this->idade} | " .
               "Nacionalidade: {$this->nacionalidade} | " .
               "Fidelidade: {$this->dadosTorcedor['fidelidade']} | " .
               "Tipo: {$this->dadosTorcedor['tipo']}";
    }

    // ---------------- Getters ----------------
    public function getFidelidade(): string
    {
        return $this->dadosTorcedor['fidelidade'];
    }

    public function getTipo(): string
    {
        return $this->dadosTorcedor['tipo'];
    }

    public function getDadosTorcedor(): array
    {
        return $this->dadosTorcedor;
    }

    // ---------------- Setters ----------------
    public function setFidelidade(string $fidelidade): void
    {
        $fidelidade = trim($fidelidade);
        if ($fidelidade === "") {
            throw new \InvalidArgumentException("Fidelidade inválida.");
        }
        $this->dadosTorcedor['fidelidade'] = $fidelidade;
    }

    public function setTipo(string $tipo): void
    {
        $tipo = strtolower(trim($tipo));
        if (!in_array($tipo, ["organizada", "comum"], true)) {
            throw new \InvalidArgumentException("Tipo de torcedor inválido.");
        }
        $this->dadosTorcedor['tipo'] = $tipo;
    }

    // ---------------- Métodos específicos ----------------
    public function torcer(): string
    {
        return "{$this->getNome()} está torcendo!";
    }

    // ✅ MELHORIA: Método específico baseado no tipo
    public function gritar(): string
    {
        if ($this->dadosTorcedor['tipo'] === "organizada") {
            return "{$this->nome} está puxando o grito da torcida organizada!";
        }
        return "{$this->nome} está gritando pelo time!";
    }
}