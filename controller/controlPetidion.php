<?php

include_once '../../model/modelPetidion.php';
include_once '../../model/modelUsuario.php';

class controlPetidion
{

    public function VerEstadosPeticiones($id_peticion)
    {
        $peti = new modelPetidion();
        return $peti->VerEstadosPeticiones($id_peticion);
    }

    public function NuevoTipoPeticion($nombre_tipo_peticion)
    {
        $peti           = new modelPetidion();
        @session_start();
        $id_dependencia = $_SESSION['id_dependencia'];
        $peti->NuevoTipoPeticion($nombre_tipo_peticion, $id_dependencia);
    }

    public function EditTipoPeticion($id_tipo_peticion, $nombre_tipo_peticion)
    {
        $peti = new modelPetidion();
        $peti->EditTipoPeticion($id_tipo_peticion, $nombre_tipo_peticion);
    }

    public function VerPeticionesCiudadano($id_estado, $id_tipo, $id_dependencia_tipo, $fecha_ini, $fecha_fin)
    {
        $peti       = new modelPetidion();
        @session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $data       = $peti->VerPeticionesCiudadano($id_usuario, $id_estado, $id_tipo, $id_dependencia_tipo, $fecha_ini, $fecha_fin);
        return $data;
    }

    public function VerTiposPeticiones()
    {
        $peti       = new modelPetidion();
        @session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $res        = $peti->VerTiposPeticiones($id_usuario);
        return $res;
    }

    public function VerTiposPeticionesAll($id_dependencia)
    {
        $peti = new modelPetidion();
        $res  = $peti->VerTiposPeticionesAll($id_dependencia);
        return $res;
    }

    public function VerSolicitantes($busqueda)
    {
        $peti = new modelPetidion();
        return $peti->VerSolicitantes($busqueda);
    }

    public function ActualizarPeticion($id_peticion, $id_estado, $documento, $nombre, $apellido, $celular, $telefono, $correo, $id_tipo, $id_vereda, $descripcion)
    {
        $user = new modelUsuario();
        $peti = new modelPetidion();
        $peti->ActualizarPeticion($id_peticion, $id_estado, $descripcion);
        $user->newusuario($nombre, $apellido, $documento, $telefono, $celular, $correo);
    }

    public function CambioEstadoPeticion($id_peticion, $id_estado, $descripcion)
    {
        @session_start();
        $id_usuario                  = $_SESSION['id_usuario'];
        $fecha_hora                  = date('Y-m-d H:i:s');
        $peti                        = new modelPetidion();
        $id_peticion_estado_anterior = $peti->cambioEstadoPeticion($id_peticion, $id_estado, $descripcion,$fecha_hora);
        $peti->CambioEstado($descripcion, $fecha_hora, $id_peticion, $id_peticion_estado_anterior, $id_estado, $id_usuario);
    }

    public function VerPeticion($id_solicitud)
    {
        $peti = new modelPetidion();
        $data = $peti->VerPeticion($id_solicitud);
        if ($data['url'] === '#')
        {
            $data['url'] = 'No se han adjuntado archivos' .
                    '<input type="file" id="files" name="files" class="form form-control">';
        }
        else
        {
            $data['url'] = '<a class="btn btn-success" target="_blank" href="' . $data['url'] . '"> Ver archivo</a><input type="hidden" id="files" name="files"/>';
        }
        return $data;
    }

    public function VerPeticionesEstados()
    {
        $peti = new modelPetidion();
        return $peti->VerPeticionesEstados();
    }

    public function newpeticion($id_tipo, $id_usuario, $descripcion, $id_vereda)
    {
        $peti       = new modelPetidion();
        $fecha_hora = date('Y-m-d H:i:s');
        $id_estado  = 1;
        return $peti->newpeticion($id_tipo, $fecha_hora, $id_estado, $id_usuario, $descripcion, $id_vereda);
    }

    private function menuSolicitud($id_peticion)
    {

        $html = '<div class="btn-group" role="group" style="position: relative; display: flex;vertical-align: middle;">';
        $html .= '<button onclick="edit(' . $id_peticion . ');" class="form form-control btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></button>';
        $html .= '</div>';
        return $html;
    }

    public function VerPeticiones($id_filt_ciudadano, $filt_ciudadano, $Fechaini, $Fechafin, $Estado, $filt_id_tipo)
    {
        $peti              = new modelPetidion();
        $id_filt_ciudadano = trim($id_filt_ciudadano);
        $filt_ciudadano    = trim($filt_ciudadano);
        $Fechaini          = trim($Fechaini);
        $Fechafin          = trim($Fechafin);
        $Estado            = trim($Estado);
        $Data              = $peti->VerPeticiones($id_filt_ciudadano, $filt_ciudadano, $Fechaini, $Fechafin, $Estado, $filt_id_tipo);
        $Res               = array();
        if (!is_null($peti))
        {
            foreach ($Data as $temp)
            {
                $temp['id_peticion'] = $this->menuSolicitud($temp['id_peticion']);
                if ($temp['url'] == '#')
                {
                    $temp['url'] = '<span class="label label-danger">No hay archivos</span>';
                }
                else
                {
                    $temp['url'] = '<a target="_blank" href="./' . $temp['url'] . '"><button class="btn btn-success form form-control"><i class="glyphicon glyphicon-folder-open"></i></button></a>';
                }
                $Res[] = $temp;
            }
        }
        return $Res;
    }

}
