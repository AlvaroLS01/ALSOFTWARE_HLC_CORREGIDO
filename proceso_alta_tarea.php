<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Recuperar parámetros
$nombre = $_POST['txtNombre'];
$descripcion = $_POST['txtDescripcion'];
$idProyecto = $_POST['lstProyecto']; 

// Preparar la consulta para insertar en la tabla 'tareas'
$sql = "INSERT INTO tareas(nombre, descripcion, idproyecto) VALUES (?, ?, ?);";

$stmt = $conexion->prepare($sql);
if (!$stmt) {
    die("Error preparando la consulta: " . $conexion->error);
}

// Vincular parámetros a la consulta preparada
$stmt->bind_param("ssi", $nombre, $descripcion, $idProyecto);

// Ejecutar consulta
if ($stmt->execute()) {
    $mensaje = "<h2 class='text-center mt-5'>Tarea insertada con éxito</h2>";
} else {
    $numerror = mysqli_errno($conexion);
    $descrerror = mysqli_error($conexion);
    $mensaje = "<h2 class='text-center mt-5'>Se ha producido un error número $numerror que corresponde a: $descrerror</h2>";
}

$stmt->close();
$conexion->close();

// Mostrar mensaje
echo $mensaje;

// ESTO LO PONGO PARA QUE TARDE UNOS SEGUNDOS Y TE DEVUELVA A LA PAGINA DE KA WEBAPP
echo "<script>setTimeout(function(){ window.location.href = 'alta_tarea.php'; }, 2000);</script>";
?>
