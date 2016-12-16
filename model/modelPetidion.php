<?php

include_once 'activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class modelPetidion
{

    private $Log;

    public function __construct()
    {
        include_once '../../controller/controlLog.php';
        $this->Log = new controlLog();
    }

    public function VerEstadosPeticiones($id_peticion)
    {
        $sql = 'SELECT 
                    
                    DATE_FORMAT(`peticion_control`.`fecha_hora`,\'%Y-%m-%d %h:%i:%s %p\') AS `fecha_hora_cambio_estado`,
                    `peticion_estado`.`descripcion` AS `estado_anterior`,
                    `peticion_estado1`.`descripcion` AS `estado_nuevo`,
                    CONCAT_WS(\' \', `usuario`.`nombre`, `usuario`.`apellido`) AS `usuario_cambio`,
                      `peticion_control`.`descripcion` AS `razon_cambio`
                  FROM
                    `peticion_control`
                    INNER JOIN `peticion_estado` ON (`peticion_control`.`id_peticion_estado_anterior` = `peticion_estado`.`id_peticion_estado`)
                    INNER JOIN `peticion_estado` `peticion_estado1` ON (`peticion_control`.`id_peticion_estado_nuevo` = `peticion_estado1`.`id_peticion_estado`)
                    INNER JOIN `usuario` ON (`peticion_control`.`id_usuario` = `usuario`.`id_usuario`)
                  WHERE
                    `peticion_control`.`id_peticion` = ?
                    ORDER BY
                    2';
        $con = App::$base;
        $Res = $con->Records($sql, array($id_peticion));
        return $Res;
    }

    public function EditTipoPeticion($id_dependencia_tipo, $descripcion)
    {

        $peticion = atable::Make('dependencia_tipo');
        $peticion->Load("id_dependencia_tipo={$id_dependencia_tipo}");
        if (!is_null($peticion->id_dependencia_tipo))
        {
            $before                = $peticion->_original;
            $peticion->descripcion = $descripcion;
            $peticion->Save();
            $this->Log->update($peticion->_table, $peticion->_original, $before);
        }
    }

    public function NuevoTipoPeticion($descripcion, $id_dependencia)
    {
        $peticion                 = atable::Make('dependencia_tipo');
        $peticion->id_dependencia = $id_dependencia;
        $peticion->descripcion    = $descripcion;
        $peticion->Save();
        $this->Log->Insert($peticion->_table, $peticion->_original);
    }

    public function VerPeticionesCiudadano($id_usuario, $id_estado, $id_tipo, $id_dependencia_tipo, $fecha_ini, $fecha_fin)
    {
        $Wheres    = array();
        $Filtros   = array();
        $Filtros[] = $id_usuario;
        $Wheres[]  = ' `peticion`.`id_usuario` = ? ';
        if ($id_estado != '-1' && trim($id_estado) !== '')
        {
            $Wheres[]  = ' `peticion`.`id_estado`=? ';
            $Filtros[] = $id_estado;
        }
        if ($id_tipo != '-1' && trim($id_tipo) !== '')
        {
            $Wheres[]  = ' `peticion`.`id_tipo`= ? ';
            $Filtros[] = $id_tipo;
        }
        if ($id_dependencia_tipo != '-1' && trim($id_dependencia_tipo) !== '')
        {
            $Wheres[]  = ' `dependencia`.`id_dependencia` = ? ';
            $Filtros[] = $id_dependencia_tipo;
        }
        if (trim($fecha_ini) != '')
        {
            $Wheres[]  = ' date(`peticion`.`fecha_hora`) >= date(?) ';
            $Filtros[] = $fecha_ini;
        }
        if (trim($fecha_fin) != '')
        {
            $Wheres[]  = ' date(?) >= date(`peticion`.`fecha_hora`) ';
            $Filtros[] = $fecha_fin;
        }
        $wheresql = implode(' and ', $Wheres);
        $sql      = 'SELECT 
                    `peticion`.`fecha_hora`,
                    `peticion_estado`.`descripcion` as estado,
                    `dependencia_tipo`.`descripcion` as tipo,
                    `dependencia`.`nombre`,
                    `peticion`.`descripcion`,
                    COALESCE(`peticion`.`fecha_hora_respuestad`,\'No hay respuesta\') as fecha_hora_respuestad
                FROM
                    `peticion_estado`
                    INNER JOIN `peticion` ON (`peticion_estado`.`id_peticion_estado` = `peticion`.`id_estado`)
                    INNER JOIN `dependencia_tipo` ON (`peticion`.`id_tipo` = `dependencia_tipo`.`id_dependencia_tipo`)
                    INNER JOIN `dependencia` ON (`dependencia_tipo`.`id_dependencia` = `dependencia`.`id_dependencia`)
                WHERE
                    ' . $wheresql . '
                    ORDER BY
                    `peticion`.`fecha_hora` DESC,
                    `peticion_estado`.`descripcion`,
                    `dependencia_tipo`.`descripcion`';
        $con      = App::$base;
        $Res      = $con->Records($sql, $Filtros);
        return $Res;
    }

    public function VerTiposPeticiones($id_usuario)
    {
        $sql = 'SELECT 
  `dependencia_tipo`.`id_dependencia_tipo`,
  `dependencia_tipo`.`descripcion`
FROM
  `dependencia_tipo`
  INNER JOIN `dependencia` ON (`dependencia_tipo`.`id_dependencia` = `dependencia`.`id_dependencia`)
  INNER JOIN `dependencia_encargado` ON (`dependencia`.`id_dependencia` = `dependencia_encargado`.`id_dependencia`)
  INNER JOIN `usuario` ON (`dependencia_encargado`.`id_usuario_encargado` = `usuario`.`id_usuario`)
  WHERE
    `usuario`.`id_usuario`=?';
        $con = App::$base;
        $Res = $con->Records($sql, array($id_usuario));
        return $Res;
    }

    public function VerTiposPeticionesAll($id_dependencia)
    {
        $sql = 'SELECT 
                    `dependencia_tipo`.`id_dependencia_tipo`,
                    `dependencia_tipo`.`descripcion`
                FROM
                    `dependencia_tipo`
                WHERE
                    `dependencia_tipo`.`id_dependencia`=?';
        $con = App::$base;
        $Res = $con->Records($sql, array($id_dependencia));
        return $Res;
    }

    public function VerSolicitantes($busqueda)
    {
        $sql = "SELECT 
                    `usuario`.`id_usuario`,
                    CONCAT_WS(' ', `usuario`.`nombre`, `usuario`.`apellido`) AS `value`
                FROM
                    `usuario`
                WHERE
                    `usuario`.`nombre` LIKE '%{$busqueda}%' OR 
                    `usuario`.`apellido` LIKE '%{$busqueda}%' OR
                    `usuario`.`documento` LIKE '%{$busqueda}%'";
        $con = App::$base;
        $Res = $con->Records($sql, array());
        return $Res;
    }

    public function ActualizarPeticion($id_peticion, $id_estado, $respuesta)
    {
        $peticion                        = atable::Make('peticion');
        $peticion->Load("id_peticion={$id_peticion}");
        $data_before                     = $peticion->_original;
        $peticion->id_estado             = $id_estado;
        $peticion->respuesta             = $respuesta;
        $peticion->fecha_hora_respuestad = date('Y-m-d h:i:s');
        $peticion->Save();
        $this->Log->update($peticion->_table, $peticion->_original, $data_before);
    }

    public function CambioEstado($descripcion, $fecha_hora, $id_peticion, $id_peticion_estado_anterior, $id_peticion_estado_nuevo, $id_usuario)
    {
        $peticion                              = atable::Make('peticion_control');
        $data_before                           = $peticion->_original;
        $peticion->descripcion                 = $descripcion;
        $peticion->fecha_hora                  = $fecha_hora;
        $peticion->id_peticion                 = $id_peticion;
        $peticion->id_peticion_estado_anterior = $id_peticion_estado_anterior;
        $peticion->id_peticion_estado_nuevo    = $id_peticion_estado_nuevo;
        $peticion->id_usuario                  = $id_usuario;
        $peticion->Save();
        $this->Log->update($peticion->_table, $peticion->_original, $data_before);
    }

    public function cambioEstadoPeticion($id_peticion, $id_estado, $respuesta, $fecha_hora)
    {
        $peticion                        = atable::Make('peticion');
        $peticion->Load("id_peticion = {$id_peticion}");
        $data_before                     = $peticion->_original;
        $id_estado_anterior              = $peticion->id_estado;
        $peticion->fecha_hora_respuestad = $fecha_hora;
        $peticion->id_estado             = $id_estado;
        $peticion->respuesta             = $respuesta;
        $peticion->Save();
        $this->Log->update($peticion->_table, $peticion->_original, $data_before);
        return $id_estado_anterior;
    }

    public function VerPeticion($id_solicitud)
    {
        $sql = "SELECT 
                    `peticion`.`id_peticion`,
                    `peticion`.`fecha_hora`,
                    `peticion_estado`.`id_peticion_estado`,
                    `peticion_estado`.`descripcion` AS `estado`,
                    `peticion`.`descripcion` AS `detalle`,
                    COALESCE(`peticion_files`.`url`, '#') AS `url`,
                    `usuario`.`apellido`,
                    `usuario`.`documento`,
                    `usuario`.`telefono`,
                    `usuario`.`celular`,
                    COALESCE(`usuario`.`correo`,'NN') as correo,
                    `usuario`.`login`,
                    `peticion`.`id_tipo`,
                    `usuario`.`id_usuario_tipo`,
                    `usuario`.`nombre`,
                    `peticion`.`id_vereda`,
                    `peticion`.`descripcion`,
                    `dependencia_tipo`.`descripcion` as descripcion_tipo_dependencia,
                     `vereda`.`nombre` as nombre_vereda,
                     `peticion`.`respuesta`
                FROM
                    `peticion_files`
                    RIGHT OUTER JOIN `peticion` ON (`peticion_files`.`id_peticion` = `peticion`.`id_peticion`)
                    INNER JOIN `usuario` ON (`peticion`.`id_usuario` = `usuario`.`id_usuario`)
                    INNER JOIN `peticion_estado` ON (`peticion`.`id_estado` = `peticion_estado`.`id_peticion_estado`)
                    INNER JOIN `dependencia_tipo` ON (`peticion`.`id_tipo` = `dependencia_tipo`.`id_dependencia_tipo`)
                    INNER JOIN `dependencia` ON (`dependencia_tipo`.`id_dependencia` = `dependencia`.`id_dependencia`)
                    INNER JOIN `vereda` ON (`peticion`.`id_vereda` = `vereda`.`id_vereda`)
                WHERE
                    `peticion`.`id_peticion` = ?";
        $con = App::$base;
        $Res = $con->Record($sql, array($id_solicitud));
        return $Res;
    }

    public function VerPeticionesEstados()
    {
        $sql = "SELECT 
                    `peticion_estado`.`id_peticion_estado`,
                    `peticion_estado`.`descripcion`
                FROM
                    `peticion_estado`
                ORDER BY 2";
        $con = App::$base;
        $Res = $con->Records($sql, array());
        return $Res;
    }

    public function newpeticion($id_tipo, $fecha_hora, $id_estado, $id_usuario, $descripcion, $id_vereda)
    {
        $peticion              = atable::Make('peticion');
        $peticion->id_tipo     = $id_tipo;
        $peticion->fecha_hora  = $fecha_hora;
        $peticion->id_estado   = $id_estado;
        $peticion->id_usuario  = $id_usuario;
        $peticion->descripcion = $descripcion;
        $peticion->id_vereda   = $id_vereda;
        $peticion->Save();
        $this->Log->Insert($peticion->_table, $peticion->_original);
        return $peticion->id_peticion;
    }

    public function VerPeticiones($id_ciudadano, $NombreCiudadano, $Fechaini, $Fechafin, $id_peticion_estado, $filt_id_tipo)
    {
        $WhereSQL       = array();
        $WhereFilter    = array();
        $wheresqlfilter = '';
        if ($id_ciudadano != '')
        {
            $WhereSQL[]    = ' `usuario`.`id_usuario`= ? ';
            $WhereFilter[] = $id_ciudadano;
        }
        if ($filt_id_tipo != '-1')
        {
            $WhereSQL[]    = ' `peticion`.`id_tipo`= ? ';
            $WhereFilter[] = $filt_id_tipo;
        }
        if (FALSE/* $NombreCiudadano != '' */)
        {
            $WhereSQL[]    = ' ';
            $WhereFilter[] = $NombreCiudadano;
        }
        if ($Fechaini != '')
        {
            $WhereSQL[]    = ' date(?) <= date(`peticion`.`fecha_hora`) ';
            $WhereFilter[] = $Fechaini;
        }
        if ($Fechafin != '')
        {
            $WhereSQL[]    = ' date(`peticion`.`fecha_hora`) <= date(?) ';
            $WhereFilter[] = $Fechafin;
        }
        if ($id_peticion_estado != '-1')
        {
            $WhereSQL[]    = ' `peticion_estado`.`id_peticion_estado` = ? ';
            $WhereFilter[] = $id_peticion_estado;
        }
        if (count($WhereFilter) > 0)
        {
            $wheresqlfilter = 'WHERE ' . "\n" . implode(' AND ' . "\n", $WhereSQL);
        }
        $sql = "SELECT 
                  `peticion`.`id_peticion`,
                  COALESCE(`peticion_files`.`url`,'#') as url,
                  CONCAT_WS(' ', `usuario`.`nombre`, `usuario`.`apellido`) AS `ciudadano`,
                  `peticion`.`fecha_hora`,
                  `peticion_estado`.`descripcion` AS `estado`,
                  CONCAT(SUBSTRING(`peticion`.`descripcion` FROM 1 FOR 10),'...') AS `detalle`,
                `dependencia_tipo`.`descripcion` as dependencia_tipo_descripcion
                FROM
                  `peticion_files`
                    RIGHT OUTER JOIN `peticion` ON (`peticion_files`.`id_peticion` = `peticion`.`id_peticion`)
                    INNER JOIN `usuario` ON (`peticion`.`id_usuario` = `usuario`.`id_usuario`)
                    INNER JOIN `peticion_estado` ON (`peticion`.`id_estado` = `peticion_estado`.`id_peticion_estado`)
                    INNER JOIN `dependencia_tipo` ON (`peticion`.`id_tipo` = `dependencia_tipo`.`id_dependencia_tipo`)
                {$wheresqlfilter}
                GROUP BY `peticion`.`id_peticion`
                ORDER BY
                date(`peticion`.`fecha_hora`) DESC,
                HOUR(`peticion`.`fecha_hora`) DESC";
        $con = App::$base;
        $Res = $con->Records($sql, $WhereFilter);
        return $Res;
    }

}