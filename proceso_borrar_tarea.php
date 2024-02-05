<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetros
$idtarea = $_POST['idtarea']; 

// No validamos, suponemos que la entrada de datos es correcta

// Definir delete
$sql = "DELETE FROM tareas WHERE idtarea = ?;"; // Usamos consultas preparadas para evitar inyecciones SQL

// Preparar consulta
$stmt = $conexion->prepare($sql);
if (!$stmt) {
    die("Error preparando la consulta: " . $conexion->error);
}

// Vincular parámetros y ejecutar
$stmt->bind_param("i", $idtarea);
if (!$stmt->execute()) {
    $mensaje = "<h2 class='text-center mt-5'>Se ha producido un error: " . $stmt->error . "</h2>";
} else {
    $mensaje = "<h2 class='text-center mt-5'>Tarea con id $idtarea borrada</h2>"; 
}

// Cerrar statement
$stmt->close();

include_once("WebApp.html");

// Mostrar mensaje calculado antes
echo $mensaje;

?>
