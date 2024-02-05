<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetros
$nombre = $_POST['txtNombreProyecto'];
$descripcion = $_POST['txtDescripcionProyecto'];
$fechaInicio = $_POST['txtFechaInicio'];
$fechaFin = $_POST['txtFechaFin'];

// Preparar la consulta para insertar en la tabla 'proyectos'
$sql = "INSERT INTO proyectos(nombre, descripcion, f_ini, f_fin) VALUES (?, ?, ?, ?);";

$stmt = $conexion->prepare($sql);
if (!$stmt) {
    die("Error preparando la consulta: " . $conexion->error);
}

// Vincular parámetros a la consulta preparada
$stmt->bind_param("ssss", $nombre, $descripcion, $fechaInicio, $fechaFin);

// Ejecutar consulta
if ($stmt->execute()) {
    $mensaje = "<h2 class='text-center mt-5'>Proyecto insertado con éxito</h2>";
} else {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);
    $mensaje = "<h2 class='text-center mt-5'>Se ha producido un error número $numerror que corresponde a: $descrerror</h2>";
}

$stmt->close();
$conexion->close();

// Mostrar mensaje
echo $mensaje;

// Usar JavaScript para redireccionar después de 5 segundos
echo "<script>setTimeout(function(){ window.location.href = 'alta_proyecto.php'; }, 5000);</script>";
?>
