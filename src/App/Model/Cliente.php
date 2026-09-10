<?php

namespace App\Model;

use App\App\Model\Cuenta;

class Cliente
{
    private string $nombre;
    private string $dni;
    private Cuenta $cuenta;

    public function __construct(string $nombre, string $dni, Cuenta $cuenta)
    {
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->cuenta = $cuenta;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    public function setDni(string $dni): void
    {
        $this->dni = $dni;
    }

    public function getCuenta(): Cuenta
    {
        return $this->cuenta;
    }

    public function setCuenta(Cuenta $cuenta): void
    {
        $this->cuenta = $cuenta;
    }
}