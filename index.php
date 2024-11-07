<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reserva de Vehículo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<div class="contenedor">
      <h1 class="titulo">Reservas de Vehículos</h1>

      <!-- Formulario de la Reserva -->
      <form action="procesar_reserva.php" method="post" class="formulario sombra">
        <div class="campos">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" />
        </div>
        <div class="campos">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" />
        </div>
        <div class="campos">
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" />
        </div>
        
        <div class="campos">
            <label for="modelo">Modelo del Vehículo:</label>
            <select id="modelo" name="modelo" >
              <option value="Lancia Stratos">Lancia Stratos</option>
              <option value="Audi Quattro">Audi Quattro</option>
              <option value="Ford Escort RS1800">Ford Escort RS1800</option>
              <option value="Subaru Impreza 555">Subaru Impreza 555</option>
            </select>
        </div>

        <div class="campos">
            <label for="fechaInicio">Fecha de Inicio de la Reserva:</label>
            <input type="date" id="fechaInicio" name="fechaInicio" />
        </div>
        
        <div class="campos">
            <label for="duracion">Duración de la Reserva(en días):</label>
            <input type="number" id="duracion" name="duracion" />
        </div>

        <div class="campos">
          <button type="submit" class="btn">Reservar</button>
        </div>
      </form>
    </div>
</body>
</html>
