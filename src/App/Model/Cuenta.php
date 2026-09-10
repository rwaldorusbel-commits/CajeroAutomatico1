<?php

namespace App;
namespace App\App\Model;

use App\App\Interfaces\OperacionesBancarias;

abstract class Cuenta implements OperacionesBancarias
{
    private string $numeroCuenta;
    private float $saldo;
    private string $pin;

    protected string $titular;

    public function __construct(string $numeroCuenta, string $titular, string $pin, float $saldoInicial)
    {
        $this->numeroCuenta = $numeroCuenta;
        $this->titular = $titular;
        $this->pin = $pin;
        $this->saldo = $saldoInicial;
    }

    public function getNumeroCuenta(): string
    {
        return $this->numeroCuenta;
    }

    public function getTitular(): string
    {
        return $this->titular;
    }

    public function setTitular(string $titular): void
    {
        $this->titular = $titular;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    protected function setSaldo(float $saldo): void
    {
        $this->saldo = $saldo;
    }

    private function validarPin(string $pinIngresado): bool
    {
        return $this->pin === $pinIngresado;
    }

    public function autenticar(string $pinIngresado): bool
    {
        return $this->validarPin($pinIngresado);
    }

    public function depositar(float $monto): void
    {
        if ($monto > 0) {
            $this->setSaldo($this->getSaldo() + $monto);
        }
    }

    public function retirar(float $monto): bool
    {
        if ($monto > 0 && $monto <= $this->saldo) {
            $this->setSaldo($this->getSaldo() - $monto);
            return true;
        }
        return false;
    }

    public function consultarSaldo(): float
    {
        return $this->saldo;
    }

    abstract public function calcularInteres(): float;
}