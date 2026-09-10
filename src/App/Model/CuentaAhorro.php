<?php


namespace App\Model;

use App\App\Model\Cuenta;
use App\Interfaces\OperacionesBancarias;

class CuentaAhorro extends Cuenta
{
    private float $tasaInteres;

    public function __construct(
        string $numeroCuenta,
        string $titular,
        string $pin,
        float $saldoInicial,
        float $tasaInteres
    ) {
        parent::__construct($numeroCuenta, $titular, $pin, $saldoInicial);
        $this->tasaInteres = $tasaInteres;
    }

    public function getTasaInteres(): float
    {
        return $this->tasaInteres;
    }

    public function setTasaInteres(float $tasaInteres): void
    {
        $this->tasaInteres = $tasaInteres;
    }

    public function retirar(float $monto): bool
    {
        $montoMinimo = 20.0;
        if ($monto < $montoMinimo) {
            echo "Retiro mínimo en Cuenta de Ahorro: S/ {$montoMinimo}\n";
            return false;
        }
        return parent::retirar($monto);
    }

    public function calcularInteres(): float
    {
        return $this->getSaldo() * $this->tasaInteres;
    }
}