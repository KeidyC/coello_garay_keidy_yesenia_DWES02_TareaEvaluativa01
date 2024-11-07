<?php
session_start();
$validacion = $_SESSION['validacion'] ?? [];
session_unset();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errores en la Reserva</title>
    <style>
        .error { color: red; }
        .valido { color: green; }
        .colorRojo { color: red; }
        a{color:black}
    </style>
</head>
<body>
    <!-- Confirmacion de reserva no valida -->
    <h1>Errores en la Reserva</h1>
        <?php
        // Verificamos si el DNI no es válido o el usuario no está registrado
        $dniNoValido = isset($validacion['dni']) && !$validacion['dni']['valido'];
        $usuarioNoRegistrado = isset($validacion['usuario']) && !$validacion['usuario']['valido'];
        
        foreach ($validacion as $campo => $resultado): ?>
            <p class="<?php
                // Aplica 'colorRojo' a nombre y apellido si el usuario no está registrado
                echo (($dniNoValido || $usuarioNoRegistrado) && ($campo === 'nombre' || $campo === 'apellido')) ? 'colorRojo' : ($resultado['valido'] ? 'valido' : 'error');
            ?>">
            <?php 
                echo ucfirst($campo) . ': '; 
                if ($resultado['valido']) {
                    // Si es válido, muestra el valor ingresado
                    echo htmlspecialchars($resultado['valor'] ?? '');
                } else {
                    // Si no es válido, muestra el mensaje de error
                    echo htmlspecialchars($resultado['mensaje']);
                }
            ?>
            </p>
        <?php endforeach; ?>
   
    <a href="index.php">Volver al formulario</a>
</body>
</html>
