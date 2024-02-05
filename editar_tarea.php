<?php

// Recupero datos de parámetro en forma de array asociativo
$tarea = json_decode($_POST['tarea'], true);

require_once("funcionesBD.php");
$conexion = obtenerConexion();

// Consulta para obtener todos los proyectos y poder seleccionar a cuál pertenece la tarea
$sql = "SELECT idproyecto, nombre FROM proyectos;";

$resultado = mysqli_query($conexion, $sql);

$options = "";
while ($fila = mysqli_fetch_assoc($resultado)) {
    // Si coincide el proyecto con el de la tarea es el que debe aparecer seleccionado (selected)
    if ($fila['idproyecto'] == $tarea['idproyecto']){
        $options .= " <option selected value='" . $fila["idproyecto"] . "'>" . $fila["nombre"] . "</option>";
    } else{
        $options .= " <option value='" . $fila["idproyecto"] . "'>" . $fila["nombre"] . "</option>";
    }
}

// Cabecera HTML que incluye navbar
include_once("WebApp.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_modificar_tarea.php" name="frmEditarTarea" id="frmEditarTarea" method="post">
            <fieldset>
                <!-- Form Name -->
                <legend>Modificación de Tarea</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombre">Nombre</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $tarea['nombre'] ?>" id="txtNombre" name="txtNombre" placeholder="Nombre de la tarea" class="form-control input-md" type="text" required>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtDescripcion">Descripción</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $tarea['descripcion'] ?>" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción" class="form-control input-md" type="text" required>
                    </div>
                </div>
                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="lstProyecto">Proyecto</label>
                    <div class="col-xs-4">
                        <select id="lstProyecto" name="lstProyecto" class="form-select" required>
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <input value="<?php echo $tarea['idtarea'] ?>" type="hidden" name="idtarea" id="idtarea" />
                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarEditarTarea"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarEditarTarea" name="btnAceptarEditarTarea" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
