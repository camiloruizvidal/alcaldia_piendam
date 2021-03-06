<?php

include_once '../../model/modelDependencia.php';

class controlDependencias
{

    public function NewDependencia($descripcion, $codigo)
    {
        $Dependencia = new modelDependencia();
        $Dependencia->NewDependencia($descripcion, $codigo);
    }

    public function DependenciaUsuario($id_dependencia, $id_usuario)
    {
        $Dependencia = new modelDependencia();
        $Dependencia->DependenciaUsuario($id_dependencia, $id_usuario);
    }

    public function EditarDependencia($id_dependencia, $descripcion, $codigo)
    {
        $Dependencia = new modelDependencia();
        $Dependencia->EditarDependencia($id_dependencia, $descripcion, $codigo);
    }

    public function TiposDependencias($id_dependencia)
    {
        $Dependencia = new modelDependencia();
        @session_start();
        $id_usuario  = $_SESSION['id_usuario'];
        $Datos       = $Dependencia->TiposDependencias($id_usuario, $id_dependencia);
        return $Datos;
    }

    public function Dependencias_peticiones()//Muestras todas las dependencias que tiene un usuario en sus peticiones
    {
        $Dependencia = new modelDependencia();
        @session_start();
        $id_usuario  = $_SESSION['id_usuario'];
        $Data        = $Dependencia->Dependencias_peticionesxUser($id_usuario);
        return $Data;
    }

    public function Dependencias_All()//Muestras todas las dependencias 
    {
        $Dependencia = new modelDependencia();
        $Data        = $Dependencia->Dependencias_all();
        return $Data;
    }

    public function Dependencias_All_cod()//Muestras todas las dependencias 
    {
        $Dependencia = new modelDependencia();
        $Data        = $Dependencia->Dependencias_all_cod();
        return $Data;
    }

}
