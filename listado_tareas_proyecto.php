<?php
require_once("funcionesBD.php");

$conexion = obtenerConexion();

// Cambiamos la consulta para seleccionar proyectos en lugar de tipos de componentes
$sql = "SELECT idproyecto, nombre FROM proyectos ORDER BY idproyecto ASC;";

$resultado = mysqli_query($conexion, $sql);

$options = "";
while ($fila = mysqli_fetch_assoc($resultado)) {
    // Ahora llenamos el select con proyectos en lugar de tipos
    $options .= " <option value='" . $fila["idproyecto"] . "'>" . $fila["nombre"] . "</option>";
}

include_once("WebApp.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="listado_tareas.php" method="get">
            <fieldset>
                <!-- Form Name -->
                <legend>Buscar tareas de un proyecto</legend>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="lstProyecto">Proyecto</label>
                    <div class="col-xs-4">
                        <select name="lstProyecto" id="lstProyecto" class="form-select" aria-label="Default select example">
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarBuscarTareasProyecto"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarBuscarTareasProyecto" name="btnAceptarBuscarTareasProyecto" class="btn btn-primary" value="Buscar" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
