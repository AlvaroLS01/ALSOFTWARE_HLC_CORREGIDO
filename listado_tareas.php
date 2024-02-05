<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Verificar si se ha enviado el ID del proyecto a través de GET
if (isset($_GET['lstProyecto'])) {
    $idProyecto = $_GET['lstProyecto'];

    // Preparamos la consulta SQL usando consultas preparadas
    $sql = "SELECT t.*, p.nombre AS nombreProyecto FROM tareas t INNER JOIN proyectos p ON t.idproyecto = p.idproyecto WHERE t.idproyecto = ? ORDER BY idtarea ASC;";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idProyecto);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    // Si no se ha seleccionado un proyecto, seleccionamos todas las tareas
    $sql = "SELECT t.*, p.nombre AS nombreProyecto FROM tareas t INNER JOIN proyectos p ON t.idproyecto = p.idproyecto ORDER BY idtarea ASC;";
    $resultado = mysqli_query($conexion, $sql);
}

// Montar tabla
$mensaje = "<h2 class='text-center'>Listado de Tareas</h2>";
$mensaje .= "<table class='table table-striped'>";
$mensaje .= "<thead><tr><th>IDTAREA</th><th>NOMBRE</th><th>DESCRIPCIÓN</th><th>PROYECTO</th><th>ACCIÓN</th></tr></thead>";
$mensaje .= "<tbody>";

// Recorrer filas
while ($fila = mysqli_fetch_assoc($resultado)) {
    $mensaje .= "<tr><td>" . $fila['idtarea'] . "</td>";
    $mensaje .= "<td>" . $fila['nombre'] . "</td>";
    $mensaje .= "<td>" . $fila['descripcion'] . "</td>";
    $mensaje .= "<td>" . $fila['nombreProyecto'] . "</td>";

    // Asegúrate de ajustar los formularios de acción a tus necesidades
    $mensaje .= "<td><form class='d-inline me-1' action='editar_tarea.php' method='post'>";
    $mensaje .= "<input type='hidden' name='tarea' value='" . htmlspecialchars(json_encode($fila), ENT_QUOTES) . "' />";
    $mensaje .= "<button name='Editar' class='btn btn-primary'><i class='bi bi-pencil-square'></i></button></form>";

    $mensaje .= "<form class='d-inline' action='proceso_borrar_tarea.php' method='post'>";
    $mensaje .= "<input type='hidden' name='idtarea' value='" . $fila['idtarea']  . "' />";
    $mensaje .= "<button name='Borrar' class='btn btn-danger'><i class='bi bi-trash'></i></button></form>";

    $mensaje .= "</td></tr>";
}

// Cerrar tabla
$mensaje .= "</tbody></table>";

// Liberar resultados y cerrar statement si se usó consulta preparada
if (isset($stmt)) {
    $stmt->free_result();
    $stmt->close();
}

// Insertamos cabecera
include_once("WebApp.html");

// Mostrar mensaje calculado antes
echo $mensaje;
?>
