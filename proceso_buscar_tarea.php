<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetro
$nombreTarea = $_GET['txtNombreTarea'];

// Usar consultas preparadas para prevenir inyecciones SQL
$sql = "SELECT t.*, p.nombre AS nombreProyecto FROM tareas t 
INNER JOIN proyectos p ON t.idproyecto = p.idproyecto 
WHERE t.nombre LIKE ?;";

$stmt = $conexion->prepare($sql);
$nombreTarea = "%".$nombreTarea."%"; 
$stmt->bind_param("s", $nombreTarea);
$stmt->execute();
$resultado = $stmt->get_result();

if($fila = mysqli_fetch_assoc($resultado)){ // Mostrar tabla de datos si hay resultado
    $mensaje = "<h2 class='text-center'>Tarea localizada</h2>";
    $mensaje .= "<table class='table'>";
    $mensaje .= "<thead><tr><th>IDTAREA</th><th>NOMBRE</th><th>DESCRIPCIÓN</th><th>PROYECTO</th></tr></thead>";
    $mensaje .= "<tbody>";
    
    // Mostrar todas las filas encontradas
    do {
        $mensaje .= "<tr>";
        $mensaje .= "<td>" . $fila['idtarea'] . "</td>";
        $mensaje .= "<td>" . $fila['nombre'] . "</td>";
        $mensaje .= "<td>" . $fila['descripcion'] . "</td>";
        $mensaje .= "<td>" . $fila['nombreProyecto'] . "</td>";
        $mensaje .= "</tr>";
    } while ($fila = mysqli_fetch_assoc($resultado));
    
    $mensaje .= "</tbody></table>";
} else { // No hay datos
   $mensaje = "<h2 class='text-center mt-5'>No se encontraron tareas con ese nombre</h2>";
}

// Cerrar la declaración preparada y la conexión
$stmt->close();
$conexion->close();

// Insertamos cabecera
include_once("WebApp.html");

// Mostrar mensaje calculado antes
echo $mensaje;

?>
