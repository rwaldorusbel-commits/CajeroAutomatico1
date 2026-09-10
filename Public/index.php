<?php

namespace App;

$archivos = [
    __DIR__ . '/../src/App/Interfaces/OperacionesBancarias.php',
    __DIR__ . '/../src/App/Model/Cuenta.php',
    __DIR__ . '/../src/App/Model/CuentaAhorro.php',
    __DIR__ . '/../src/App/Model/CuentaCorriente.php',
    __DIR__ . '/../src/App/Model/Cliente.php',
    __DIR__ . '/../src/App/Service/Cajero.php',
];
foreach ($archivos as $archivo) {
    $rutaReal = realpath($archivo);
    if ($rutaReal === false) {
        die("No se encontró el archivo esperado en: {$archivo}\n" .
            "Revisa que la carpeta y el nombre del archivo existan tal cual.\n");
    }
    require_once $rutaReal;
}

use App\Model\Cliente;
use App\Model\CuentaAhorro;
use App\Model\CuentaCorriente;
use App\Service\Cajero;


$cuenta1 = new  CuentaAhorro("001-AH", "Maria Lopez", "1234", 500.0, 0.03);
$cuenta2 = new CuentaAhorro("002-CC", "Jose Perez", "5678", 200.0, 100.0);

$cliente1 = new Cliente("Maria Lopez", "45678912", $cuenta1);

$cliente2 = new Cliente("Jose Perez", "78912345", $cuenta2);

$cajero = new Cajero();
$cajero->registrarCliente($cliente1);
$cajero->registrarCliente($cliente2);

echo "Bienvenido al Cajero Automático\n";
echo "(Cuentas de prueba: 001-AH / PIN 1234   |   002-CC / PIN 5678)\n";
echo "Número de cuenta: 3333";
$numeroCuenta = trim(fgets(STDIN));