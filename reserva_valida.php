<?php
session_start();

// Obtener los datos del usuario y del vehículo
$nombre = $_GET['nombre'] ?? '';
$apellido = $_GET['apellido'] ?? '';
$modelo = $_GET['modelo'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Confirmada</title>
    
    <style>
        .confirmacion {
            color: green;
            font-weight: bold;
        }
        a{
            color:black;
        }
    </style>

</head>
<body>
    <!--Confirmación de la Reserva -->
    <h1 class="confirmacion">Reserva Confirmada</h1>
    <p>La reserva ha sido realizada correctamente:</p>
    <ul>
        <li><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></li>
        <li><strong>Apellido:</strong> <?php echo htmlspecialchars($apellido); ?></li>
        <li><strong>Vehículo:</strong> <?php echo htmlspecialchars($modelo); ?></li>
    </ul>
   
    <?php echo "<img src='img/$modelo.jpg' alt='Imagen de $modelo' width='300' height='300' />";?><br>
    <a href="index.php">Volver al formulario</a>
</body>
</html>

