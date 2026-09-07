<?php

namespace Interfaces;

interface OperacionesBancarias
{
    public function depositar(float $monto): void;

    public function retirar(float $monto): bool;

    public function consultarSaldo(): float;
}