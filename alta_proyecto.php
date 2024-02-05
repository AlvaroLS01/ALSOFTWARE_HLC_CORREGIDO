<?php
require_once("funcionesBD.php");
$conexion = obtenerConexion();

// No necesitamos seleccionar proyectos aquí, así que eliminamos esa parte

include_once("WebApp.html");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Proyecto</title>
</head>
<body>
<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_alta_proyecto.php" name="frmAltaProyecto" id="frmAltaProyecto" method="post">
            <fieldset>
                <legend>Alta de Proyecto</legend>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombreProyecto">Nombre del Proyecto</label>
                    <div class="col-xs-4">
                        <input id="txtNombreProyecto" name="txtNombreProyecto" placeholder="Nombre del proyecto" class="form-control input-md" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtDescripcionProyecto">Descripción</label>
                    <div class="col-xs-4">
                        <textarea id="txtDescripcionProyecto" name="txtDescripcionProyecto" placeholder="Descripción del proyecto" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtFechaInicio">Fecha de Inicio</label>
                    <div class="col-xs-4">
                        <input id="txtFechaInicio" name="txtFechaInicio" type="date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtFechaFin">Fecha de Fin</label>
                    <div class="col-xs-4">
                        <input id="txtFechaFin" name="txtFechaFin" type="date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarAltaProyecto" name="btnAceptarAltaProyecto" class="btn btn-primary" value="Aceptar">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
