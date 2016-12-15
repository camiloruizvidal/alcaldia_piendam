<?php

include_once '../../model/modelLogs.php';

class controlLog
{

    private $ip;
    private $id_user;
    private $fecha_hora;
    private $Log;

    private function JsonLogs($table, $Datos)
    {
        $columns = $this->Log->FieldsColumns($table);
        $Res     = array();
        for ($i = 0; $i < count($Datos); $i++)
        {
            $Res[$columns[$i]] = $Datos[$i];
        }
    }

    public function __construct()
    {
        @session_start();
        $this->ip         = $_SERVER["REMOTE_ADDR"];
        $this->id_user    = $_SESSION["id_usuario"];
        $this->fecha_hora = date('Y-m-d h:i:s');
        $this->Log        = new modelLogs();
    }

    public function Insert($table, $data_after)
    {
        $data_after = $this->JsonLogs($table, $data_after);
        $this->Log->InserLogs($this->id_user, $this->fecha_hora, $this->ip, 'insertar', $data_after, NULL, $table);
    }

    public function update($table, $data_after, $data_before)
    {
        $data_before = json_encode($data_before);
        $data_after  = json_encode($data_after);
        $this->Log->InserLogs($this->id_user, $this->fecha_hora, $this->ip, 'actualizar', $data_after, $data_before, $table);
    }

    public function delete($table, $data_before)
    {
        $data_before = json_encode($data_before);
        $this->Log->InserLogs($this->id_user, $this->fecha_hora, $this->ip, 'borrar', NULL, $data_before, $table);
    }

    public function create($table, $data_after)
    {
        $data_after = json_encode($data_after);
        $this->Log->InserLogs($this->id_user, $this->fecha_hora, $this->ip, 'crear', $data_after, NULL, $table);
    }

    public function Select($FechaInicio, $FechaFin, $id_usuario)
    {
        $this->Log->select($id_usuario, $FechaInicio, $FechaFin);
    }

}
