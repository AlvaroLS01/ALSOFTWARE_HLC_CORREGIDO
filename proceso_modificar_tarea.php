<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetros
$idtarea = $_POST['idtarea']; // Asegúrate de que este campo se envíe desde el formulario de edición
$nombre = $_POST['txtNombre'];
$descripcion = $_POST['txtDescripcion'];
$idproyecto = $_POST['lstProyecto']; // Asumimos que el formulario de edición incluye un selector de proyectos

// No validamos, suponemos que la entrada de datos es correcta

// Definir la consulta de actualización usando consultas preparadas para mejorar la seguridad
$sql = "UPDATE tareas SET nombre = ?, descripcion = ?, idproyecto = ? WHERE idtarea = ?;";

// Preparar consulta
$stmt = $conexion->prepare($sql);
if (!$stmt) {
    die("Error preparando la consulta: " . $conexion->error);
}

// Vincular parámetros y ejecutar
$stmt->bind_param("ssii", $nombre, $descripcion, $idproyecto, $idtarea);
if ($stmt->execute()) {
    $mensaje = "<h2 class='text-center mt-5'>Tarea actualizada con éxito</h2>";
} else {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);
    $mensaje = "<h2 class='text-center mt-5'>Se ha producido un error número $numerror que corresponde a: $descrerror </h2>";
}

// Cerrar sentencia y conexión
$stmt->close();
$conexion->close();

// Incluir cabecera HTML
include_once("WebApp.html");

// Mostrar mensaje
echo $mensaje;
?>
