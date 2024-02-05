<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetros del formulario de edición de proyecto
$idproyecto = $_POST['idproyecto']; // El ID del proyecto a modificar
$nombre = $_POST['txtNombreProyecto']; // El nuevo nombre del proyecto
$descripcion = $_POST['txtDescripcionProyecto']; // La nueva descripción del proyecto
$f_ini = $_POST['txtFechaInicio']; // La nueva fecha de inicio
$f_fin = $_POST['txtFechaFin']; // La nueva fecha de fin

// Definir la consulta de actualización usando consultas preparadas para mejorar la seguridad
$sql = "UPDATE proyectos SET nombre = ?, descripcion = ?, f_ini = ?, f_fin = ? WHERE idproyecto = ?;";

// Preparar consulta
$stmt = $conexion->prepare($sql);
if (!$stmt) {
    die("Error preparando la consulta: " . $conexion->error);
}

// Vincular parámetros y ejecutar
$stmt->bind_param("ssssi", $nombre, $descripcion, $f_ini, $f_fin, $idproyecto);
if ($stmt->execute()) {
    $mensaje = "<h2 class='text-center mt-5'>Proyecto actualizado con éxito</h2>";
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
