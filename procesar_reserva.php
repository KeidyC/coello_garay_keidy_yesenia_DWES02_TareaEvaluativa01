<?php

include 'datos_coches.php';

// Obtenemos los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$dni = $_POST['dni'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$fechaInicio = $_POST['fechaInicio'] ?? '';
$duracion = $_POST['duracion'] ?? 0;

// Funcion para validad el DNI del usuario
function validarDNI($dni) {
    $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    $numero = substr($dni, 0, 8);
    $letra = strtoupper(substr($dni, 8, 1));
    $letraCorrecta = $letras[$numero % 23];

    return $letra == $letraCorrecta;
}

// Funcion para validar al usuario
function validarUsuario($nombre, $apellido, $dni) {
    foreach (USUARIOS as $usuario) {
        if ($usuario['nombre'] == $nombre && $usuario['apellido'] == $apellido && $usuario['dni'] == $dni) {
            return true;
        }
    }
    return false;
}

// Funcion para Validar disponibilidad del coche
function validarDisponibilidad($modelo, $fecha_inicio, $duracion) {
    global $coches;

    foreach ($coches as &$coche) {
        if ($coche['modelo'] == $modelo) {
            if (!$coche['disponible']) {
                return "Coche no disponible";
            }
            $fecha_fin = date('Y-m-d', strtotime($fecha_inicio . " +$duracion days"));
            if (($coche['fecha_inicio'] && $fecha_inicio <= $coche['fecha_fin']) || 
                ($coche['fecha_fin'] && $fecha_fin >= $coche['fecha_inicio'])) {
                return "Fechas del coche no disponibles";
            }
            return true;
        }
    }
    return "Modelo no válido";
}


// Validación de cada campo
$validacion = [
    'nombre' => ['valido' => true, 'mensaje' => '', 'valor' => $nombre],
    'apellido' => ['valido' => true, 'mensaje' => '', 'valor' => $apellido],
    'dni' => ['valido' => true, 'mensaje' => '', 'valor' => $dni],
    'usuario' => ['valido' => true, 'mensaje' => '', 'valor' => ''],
    'fechaInicio' => ['valido' => true, 'mensaje' => '', 'valor' => $fechaInicio],
    'duracion' => ['valido' => true, 'mensaje' => '', 'valor' => $duracion],
    'modelo' => ['valido' => true, 'mensaje' => '', 'valor' => $modelo]
];

// Validación de cada campo y asignación de los valores
if (empty($nombre)) {
    $validacion['nombre'] = ['valido' => false, 'mensaje' => "El nombre no puede estar vacío", 'valor' => $nombre];
}

if (empty($apellido)) {
    $validacion['apellido'] = ['valido' => false, 'mensaje' => "El apellido no debe estar vacío", 'valor' => $apellido];
}

if (!validarDNI($dni)) {
    $validacion['dni'] = ['valido' => false, 'mensaje' => "$dni -- DNI Invalido", 'valor' => $dni];
}

if (!validarUsuario($nombre, $apellido, $dni)) {
    $validacion['usuario'] = ['valido' => false, 'mensaje' => "Usuario no registrado", 'valor' => "$nombre $apellido"];
}

if (empty($fechaInicio) || strtotime($fechaInicio) <= strtotime('today')) {
    $validacion['fechaInicio'] = ['valido' => false, 'mensaje' => "La fecha de inicio debe ser posterior a la fecha actual", 'valor' => $fechaInicio];
}

if (empty($duracion) || $duracion < 1 || $duracion > 30) {
    $validacion['duracion'] = ['valido' => false, 'mensaje' => "La duración debe estar entre 1 y 30 días", 'valor' => $duracion];
} elseif (($mensaje = validarDisponibilidad($modelo, $fechaInicio, $duracion)) !== true) {
    $validacion['modelo'] = ['valido' => false, 'mensaje' => $mensaje, 'valor' => $modelo];
}

// Comprobamos si todos los campos son válidos
$camposValidos = true;
foreach ($validacion as $campo) {
    if (!$campo['valido']) {
        $camposValidos = false;
        break;
    }
}
session_start();
if ($camposValidos) {
    header("Location: reserva_valida.php?nombre=" . urlencode($nombre) . "&apellido=" . urlencode($apellido) . "&modelo=" . urlencode($modelo));
    exit();
} else {
    $_SESSION['validacion'] = $validacion;
    header("Location: reserva_no_valida.php");
    exit();
}
?>


