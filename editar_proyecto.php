<?php
// Recupero datos de parámetro en forma de array asociativo
$proyecto = json_decode($_POST['proyecto'], true);

require_once("funcionesBD.php");
$conexion = obtenerConexion();

// No necesitamos cargar opciones de proyectos para editar un proyecto

// Cabecera HTML que incluye navbar
include_once("WebApp.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_modificar_proyecto.php" name="frmEditarProyecto" id="frmEditarProyecto" method="post">
            <fieldset>
                <!-- Form Name -->
                <legend>Modificación de Proyecto</legend>
                <!-- Text input for Project Name -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombreProyecto">Nombre del Proyecto</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $proyecto['nombre'] ?>" id="txtNombreProyecto" name="txtNombreProyecto" placeholder="Nombre del proyecto" class="form-control input-md" type="text" required>
                    </div>
                </div>
                <!-- Text input for Project Description -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtDescripcionProyecto">Descripción</label>
                    <div class="col-xs-4">
                        <textarea id="txtDescripcionProyecto" name="txtDescripcionProyecto" placeholder="Descripción del proyecto" class="form-control" required><?php echo $proyecto['descripcion'] ?></textarea>
                    </div>
                </div>
                <!-- Date input for Project Start Date -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtFechaInicio">Fecha de Inicio</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $proyecto['f_ini'] ?>" id="txtFechaInicio" name="txtFechaInicio" type="date" class="form-control" required>
                    </div>
                </div>
                <!-- Date input for Project End Date -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtFechaFin">Fecha de Fin</label>
                    <div class="col-xs-4">
                        <input value="<?php echo $proyecto['f_fin'] ?>" id="txtFechaFin" name="txtFechaFin" type="date" class="form-control" required>
                    </div>
                </div>
                <input value="<?php echo $proyecto['idproyecto'] ?>" type="hidden" name="idproyecto" id="idproyecto" />
                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarEditarProyecto"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarEditarProyecto" name="btnAceptarEditarProyecto" class="btn btn-primary" value="Aceptar" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
