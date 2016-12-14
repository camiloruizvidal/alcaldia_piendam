<?php

include_once '../../model/modelLogs.php';

class controlLog
{

    private $ip;
    private $id_user;
    private $fecha_hora;
    private $Log;

    public function __construct()
    {
        @session_start();
        $this->ip         = $_SERVER["REMOTE_ADDR"];
        $this->id_user    = $_SESSION["id_usuario"];
        $this->fecha_hora = date('Y-m-d h:i:s');
        $this->Log        = new modelLogs();
    }

    public function Insert($data_after, $table)
    {
        $this->Log->InserLogs($this->id_user, $this->fecha_hora, $this->ip, 'insertar', $data_after, NULL, $table);
    }

    public function update($data_after, $data_before, $table)
    {
        $this->Log->InserLogs($this->id_user, $this->fecha_hora, $this->ip, 'actualizar', $data_after, $data_before, $table);
    }

    public function delete($data_before, $table)
    {
        $this->Log->InserLogs($this->id_user, $this->fecha_hora, $this->ip, 'borrar', NULL, $data_before, $table);
    }

    public function create($data_after, $table)
    {
        $this->Log->InserLogs($this->id_user, $this->fecha_hora, $this->ip, 'crear', $data_after, NULL, $table);
    }

    public function Select($FechaInicio, $FechaFin, $id_usuario)
    {
        $this->Log->select($id_usuario, $FechaInicio, $FechaFin);
    }

}
