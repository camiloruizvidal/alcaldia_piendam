<?php

include_once '../../model/modelReportes.php';

class controlReportes
{

    public function VerSolicitudes($id_ciudadano, $fecha_inicio, $fecha_fin, $estado, $id_dependencia, $id_tipo_dependencia)
    {
        $rep  = new modelReportes();
        $Data = $rep->VerSolicitudes($id_ciudadano, $fecha_inicio, $fecha_fin, $estado, $id_dependencia, $id_tipo_dependencia);
        return ($Data);
    }

}
