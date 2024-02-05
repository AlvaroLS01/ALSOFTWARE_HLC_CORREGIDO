<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Consulta para seleccionar todos los proyectos
$sql = "SELECT * FROM proyectos ORDER BY idproyecto ASC;";
$resultado = mysqli_query($conexion, $sql);

// Montar tabla
$mensaje = "<h2 class='text-center'>Listado:</h2>";
$mensaje .= "<table class='table table-striped'>";
$mensaje .= "<thead><tr><th>IDPROYECTO</th><th>NOMBRE</th><th>FECHA INICIO</th><th>FECHA FIN</th><th>DESCRIPCIÓN</th><th>ACCIÓN</th></tr></thead>";
$mensaje .= "<tbody>";

// Recorrer filas
while ($fila = mysqli_fetch_assoc($resultado)) {
    $mensaje .= "<tr><td>" . $fila['idproyecto'] . "</td>";
    $mensaje .= "<td>" . $fila['nombre'] . "</td>";
    $mensaje .= "<td>" . (isset($fila['f_ini']) ? $fila['f_ini'] : 'N/A') . "</td>"; // Asegúrate de que estas columnas existen
    $mensaje .= "<td>" . (isset($fila['f_fin']) ? $fila['f_fin'] : 'N/A') . "</td>"; // y son correctas según tu base de datos
    $mensaje .= "<td>" . $fila['descripcion'] . "</td>";

    // Ajusta las acciones según lo que desees permitir, como editar o borrar proyectos
    $mensaje .= "<td><form class='d-inline me-1' action='editar_proyecto.php' method='post'>";
    $mensaje .= "<input type='hidden' name='proyecto' value='" . htmlspecialchars(json_encode($fila), ENT_QUOTES) . "' />";
    $mensaje .= "<button type='submit' name='Editar' class='btn btn-primary'><i class='bi bi-pencil-square'></i></button></form>";

    $mensaje .= "<form class='d-inline' action='proceso_borrar_proyecto.php' method='post'>";
    $mensaje .= "<input type='hidden' name='idproyecto' value='" . $fila['idproyecto']  . "' />";
    $mensaje .= "<button type='submit' name='Borrar' class='btn btn-danger'><i class='bi bi-trash'></i></button></form>";

    $mensaje .= "</td></tr>";
}

// Cerrar tabla
$mensaje .= "</tbody></table>";

include_once("WebApp.html");

// Mostrar mensaje calculado antes
echo $mensaje;
?>
