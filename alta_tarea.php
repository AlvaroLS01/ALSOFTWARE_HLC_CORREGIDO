<?php
require_once("funcionesBD.php");

$conexion = obtenerConexion();

$sql = "SELECT idproyecto, nombre FROM proyectos;"; // Corrección del nombre de la tabla

$resultado = mysqli_query($conexion, $sql);

if ($resultado === false) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

$options = "";
while ($fila = mysqli_fetch_assoc($resultado)) {
    $options .= "<option value='" . $fila["idproyecto"] . "'>" . $fila["nombre"] . "</option>";
}

include_once("WebApp.html");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Tarea</title>
</head>
<body>
<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_alta_tarea.php" name="frmAltaTarea" id="frmAltaTarea" method="post">
            <fieldset>
                <legend>Alta de Tarea</legend>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombre">Nombre</label>
                    <div class="col-xs-4">
                        <input id="txtNombre" name="txtNombre" placeholder="Nombre de la tarea" class="form-control input-md" maxlength="25" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtDescripcion">Descripción</label>
                    <div class="col-xs-4">
                        <input id="txtDescripcion" name="txtDescripcion" placeholder="Descripción" class="form-control input-md" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="lstProyecto">Proyecto</label>
                    <div class="col-xs-4">
                        <select name="lstProyecto" id="lstProyecto" class="form-select" aria-label="Default select example">
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarAltaTarea" name="btnAceptarAltaTarea" class="btn btn-primary" value="Aceptar">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
