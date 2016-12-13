<?php
include_once '../../../controller/form.php';
$form->ruta       = '../../../view/plantillas';
$form->plantilla  = 'encargado.php';
$form->parametros = array('titulo' => 'Ingreso de peticiones', 'active' => array('id_peticiones'), 'css' => array('css/source/custom-small-screens.css', 'css/source/registro_solicitudes.css'), 'js' => array('js/jquery/jquery.printPage.js', 'js/source/solicitudes_registros.js'));
$form->create(__FILE__);
?>
<#--content_ini--#>
<style>
    .modal-footer
    {
        background-color: #e5e5e5;
    }
</style>
<div class="col-md-3">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Nueva solicitud</a></li>
            <li><a href="#tabs-2">Buscar Solicitud</a></li>
        </ul>
        <div id="tabs-1">
            <form id="NuevaSolicitud" action="Ajax/AjaxGuardarSolicitud.php" method="post">
                <div class="panel-body filtros-solicitud">
                    <div class="form-group col-md-12">
                        <label>Documento</label>
                        <input required type="text" name="documento" id="documento" class="form form-control">
                    </div> 
                    <div class="form-group col-md-12">
                        <label>Nombre</label>
                        <input required type="text" name="nombre" id="nombre" class="form form-control">
                    </div> 
                    <div class="form-group col-md-12">
                        <label>Apellido</label>
                        <input required type="text" name="apellido" id="apellido" class="form form-control">
                    </div> 
                    <div class="form-group col-md-12">
                        <label>Celular</label>
                        <input type="text" name="celular" id="celular" class="form form-control">
                    </div> 
                    <div class="form-group col-md-12">
                        <label>Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form form-control">
                    </div> 
                    <div class="form-group col-md-12">
                        <label>E-mail</label>
                        <input type="email" name="correo" id="correo" class="form form-control">
                    </div> 
                    <div class="form-group col-md-12">
                        <label>tipo de petición</label>
                        <select name="id_tipo" id="id_tipo" class="form form-control">
                        </select>
                    </div> 
                    <div class="form-group col-md-12">
                        <label>Vereda</label>
                        <select name="id_vereda" id="id_vereda" class="form form-control">
                        </select>
                    </div> 
                    <div class="form-group col-md-12">
                        <label>Archivos</label>
                        <input type="file" id="files" name="files" class="form form-control"/>
                    </div>
                    <div class="col-md-12" style="padding-right: 0px;padding-left: 0px;">
                        <label>Descripcion</label>
                        <textarea id="descripcion" style="height: 150px !important;" name="descripcion" class="form form-control" rows="20" placeholder="Ingrese la descripción de la solicitud"></textarea>
                    </div>					
                    <div class="form-group col-md-12" style="padding-top: 10px;">
                        <button class="btn btn-success form form-control"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar solicitud</button>
                    </div>
                </div> 
            </form>        
        </div>
        <div id="tabs-2">
            <form id="form_search" action="Ajax/AjaxSolicitudes.php">
                <div class="panel-body filtros">
                    <div class="form-group col-md-12">
                        <label><button class="btn btn-danger" type="button" onclick="Limpiar('filt_ciudadano');Limpiar('id_filt_ciudadano');"><span class="glyphicon glyphicon-remove"></span></button>Ciudadano</label>
                        <input type="text" name="filt_ciudadano" id="filt_ciudadano" class="form form-control"/>
                        <input type="hidden" name="id_filt_ciudadano" id="id_filt_ciudadano" />
                    </div>

                    <div class="form-group col-md-12">
                        <button class="form form-control btn btn-success" onclick="FiltrarHoy();">
                            <span class="glyphicon glyphicon-time"></span> Hoy
                        </button>
                    </div>
                    <div class="form-group col-md-6">
                        <label><button class="btn btn-danger" type="button" onclick="Limpiar('Fechaini');"><span class="glyphicon glyphicon-remove"></span></button>Inicio</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                            <input type="text" name="Fechaini" id="Fechaini" class="form form-control fechahoy" style="font-size: 10px;">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label><button class="btn btn-danger" type="button" onclick="Limpiar('Fechafin');"><span class="glyphicon glyphicon-remove"></span></button>Fin</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                            <input type="text" name="Fechafin" id="Fechafin" class="form form-control fechafin" style="font-size: 10px;">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label><button class="btn btn-danger" type="button" onclick="Limpiar('Estado');"><span class="glyphicon glyphicon-remove"></span></button>Estado</label>
                        <select name="Estado" id="Estado" class="form form-control"></select>
                    </div>
                    <div class="form-group col-md-12">
                        <label><button class="btn btn-danger" type="button" onclick="Limpiar('filt_id_tipo');"><span class="glyphicon glyphicon-remove"></span></button>Tipo de peticion</label>
                        <select name="filt_id_tipo" id="filt_id_tipo" class="form form-control"></select>
                    </div>
                    <a href="#" id="imp_inf" class="btnPrint"><button class="form form-control btn btn-primary"><i class="glyphicon glyphicon-print"></i> imprimr</button></a>
                </div>  
            </form>

        </div>
    </div>
</div>
<div class="col-md-9">
    <div class="panel panel-primary">
        <div class="panel panel-heading">
            Solicitudes
        </div>
        <div class="panel panel-body">
            <div id="solicitudes_table">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="color: #fff;background-color: #d9534f;border-color: #d43f3a;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"  style="color: #fff;background-color: #5cb85c;border-color: #4cae4c;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="solicitudes">
                        <div class="col-md-6">
                            <label>Fecha de solicitud</label>
                            <input required="" type="text" name="update_fecha_hora" readonly="readonly" id="update_fecha_hora" class="form form-control">
                        </div> 
                        <div class="col-md-6">
                            <label>Estado de solicitud</label>
                            <select class="form form-control" id="update_id_estado"  name="update_id_estado">
                                <option value="">Prueba</option>
                            </select>
                        </div> 
                        <div class="col-md-6">
                            <label>Documento</label>
                            <input required="" type="text" name="update_documento" id="update_documento" class="form form-control">
                        </div> 
                        <div class="col-md-6">
                            <label>Nombre</label>
                            <input required="" type="text" name="update_nombre" id="update_nombre" class="form form-control">
                        </div> 
                        <div class="col-md-6">
                            <label>Apellido</label>
                            <input required="" type="text" name="update_apellido" id="update_apellido" class="form form-control">
                        </div> 
                        <div class="col-md-6">
                            <label>Celular</label>
                            <input type="text" name="update_celular" id="update_celular" class="form form-control">
                        </div> 
                        <div class="col-md-6">
                            <label>Telefono</label>
                            <input type="text" name="update_telefono" id="update_telefono" class="form form-control">
                        </div> 
                        <div class="col-md-6">
                            <label>E-mail</label>
                            <input type="email" name="update_correo" id="update_correo" class="form form-control">
                        </div> 
                        <div class="col-md-6">
                            <label>tipo de petición</label>
                            <select name="update_id_tipo" id="update_id_tipo" class="form form-control">
                                <option value="1">prueba 1</option>
                            </select>
                        </div> 
                        <div class="col-md-6">
                            <label>Vereda</label>
                            <select name="update_id_vereda" id="update_id_vereda" class="form form-control">
                            </select>
                        </div> 
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    <label>Archivos</label>
                                </div>
                                <div class="panel panel-body" style="padding-top: 0px;border-top-width: 0px;">
                                    <div id="update_url"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Descripcion</label>
                            <textarea id="update_detalle" style="height: 100px !important;" name="update_detalle" class="form form-control" rows="20" placeholder="Ingrese la descripción de la solicitud"></textarea>
                        </div>
                        <input type="hidden" name="update_id_peticion" id="update_id_peticion"/>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-6">
                    <button type="button" class="btn btn-success form form-control" data-dismiss="modal">Cerrar</button>
                </div>
                <div class="col-xs-6">
                    <button type="button" id="actualizar" class="btn btn-primary form form-control">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
<#--content_fin--#>