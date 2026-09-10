<?php

namespace App\Service;

use App\Model\Cliente;

class Cajero
{
   /** @var Cliente[] */
    private array $clientes = [];

    private ?Cliente $sesionActiva = null;

    public function registrarCliente(Cliente $cliente): void
    {
        $this->clientes[] = $cliente;
    }

    public function iniciarSesion(string $numeroCuenta, string $pin): bool
    {
        foreach ($this->clientes as $c) {
            if ($c->getCuenta()->getNumeroCuenta() === $numeroCuenta
                && $c->getCuenta()->autenticar($pin)) {
                $this->sesionActiva = $c;
                return true;
            }
        }
        return false;
    }

    public function cerrarSesion(): void
    {
        $this->sesionActiva = null;
    }

    public function mostrarMenu(): void
    {
        do {
            echo "\n=== CAJERO AUTOMATICO ===\n";
            echo "Cliente: " . $this->sesionActiva->getNombre() . "\n";
            echo "1. Consultar saldo\n";
            echo "2. Depositar\n";
            echo "3. Retirar\n";
            echo "4. Ver interés / beneficio de la cuenta\n";
            echo "5. Salir\n";
            echo "Elige una opción: ";
            $opcion = (int) trim(fgets(STDIN));

            $cuenta = $this->sesionActiva->getCuenta();

            switch ($opcion) {
                case 1:
                    echo "Saldo actual: S/ " . $cuenta->consultarSaldo() . "\n";
                    break;
                case 2:
                    echo "Monto a depositar: ";
                    $monto = (float) trim(fgets(STDIN));
                    $cuenta->depositar($monto);
                    echo "Depósito exitoso. Nuevo saldo: S/ " . $cuenta->getSaldo() . "\n";
                    break;
                case 3:
                    echo "Monto a retirar: ";
                    $retiro = (float) trim(fgets(STDIN));
                    if ($cuenta->retirar($retiro)) {
                        echo "Retiro exitoso. Nuevo saldo: S/ " . $cuenta->getSaldo() . "\n";
                    } else {
                        echo "No se pudo realizar el retiro.\n";
                    }
                    break;
                case 4:
                    echo "Interés / beneficio: S/ " . $cuenta->calcularInteres() . "\n";
                    break;
                case 5:
                    echo "Gracias por usar el cajero, " . $this->sesionActiva->getNombre() . "\n";
                    break;
                default:
                    echo "Opción inválida.\n";
            }
        } while ($opcion !== 5);

        $this->cerrarSesion();
    }
}