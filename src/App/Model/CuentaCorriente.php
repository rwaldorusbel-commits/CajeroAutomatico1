<?php

namespace Model;
namespace App\App\Model;

class CuentaCorriente extends Cuenta
{
    private float $sobregiroPermitido;

    public function __construct(
        string $numeroCuenta,
        string $titular,
        string $pin,
        float $saldoInicial,
        float $sobregiroPermitido
    ) {
        parent::__construct($numeroCuenta, $titular, $pin, $saldoInicial);
        $this->sobregiroPermitido = $sobregiroPermitido;
    }

    public function getSobregiroPermitido(): float
    {
        return $this->sobregiroPermitido;
    }

    public function setSobregiroPermitido(float $sobregiroPermitido): void
    {
        $this->sobregiroPermitido = $sobregiroPermitido;
    }

    public function retirar(float $monto): bool
    {
        if ($monto > 0 && ($this->getSaldo() - $monto) >= -$this->sobregiroPermitido) {
            $this->setSaldo($this->getSaldo() - $monto);
            return true;
        }
        return false;
    }

    public function calcularInteres(): float
    {
        return 0.0;
    }
}