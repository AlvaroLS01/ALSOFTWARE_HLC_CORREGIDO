<?php
include_once("WebApp.html");
?>

<div class="container" id="formularios">
    <div class="row">
        <form class="form-horizontal" action="proceso_buscar_tarea.php" name="frmBuscarTarea" id="frmBuscarTarea" method="get">
            <fieldset>
                <!-- Form Name -->
                <legend>Buscar una tarea</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="txtNombreTarea">Nombre</label>
                    <div class="col-xs-4">
                        <input id="txtNombreTarea" name="txtNombreTarea" placeholder="Nombre de la tarea" class="form-control input-md" type="text">
                    </div>
                </div>
                
                <!-- Button -->
                <div class="form-group">
                    <label class="col-xs-4 control-label" for="btnAceptarBuscarTarea"></label>
                    <div class="col-xs-4">
                        <input type="submit" id="btnAceptarBuscarTarea" name="btnAceptarBuscarTarea" class="btn btn-primary" value="Buscar" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
