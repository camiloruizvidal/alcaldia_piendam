<?php
include_once '../../../controller/form.php';
$form->ruta       = '../../../view/plantillas';
$form->plantilla  = 'encargado.php';
$form->parametros = array('titulo' => 'Ingreso de peticiones', 'active' => array('id_configuracion'), 'css' => array('css/source/custom-small-screens.css', 'css/source/registro_solicitudes.css'), 'js' => array('js/source/encargado_configuration.js'));
$form->create(__FILE__);
?>
<#--content_ini--#>
<div class="container">
    <div class="row">
        <div>
            <div class="col-xs-3 bhoechie-tab-menu">
                <div class="list-group">
                    <a href="#" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br/>Tipos de peticiones
                    </a>

                    <a href="#" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br/>Encabezado informes
                    </a>
                </div>
            </div>
            <div class="col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active">
                    <center>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span style="margin-top: 0;color:#55518a">Tipos de peticiones</span>
                            </div>
                            <div class="panel-body">
                                <div class="col-xs-9">
                                    <label>Nombre del tipo de petición</label>
                                    <input id="nombre_tipo_peticion" name="nombre_tipo_peticion" class="form form-control">
                                </div>
                                <div class="col-xs-3">
                                    <label style="color:#FFF"> a</label>
                                    <button class="btn btn-success form form-control" id="new_peticion">Guardar</button>
                                </div>
                                <div id="data_peticiones_tipo">

                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span style="margin-top: 0;color:#55518a">Encabezado informes</span>
                            </div>
                            <div class="panel-body">
                                <div id="data_veredas">
                                    <button class="form form-control btn btn-success" onclick="setEncabezado()"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar</button>
                                    <textarea class="form form-control" id="encabezado_format" style="height: 214px !important;"></textarea>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

    /*  bhoechie tab */
    div.bhoechie-tab-container{
        z-index: 10;
        background-color: #ffffff;
        padding: 0 !important;
        border-radius: 4px;
        -moz-border-radius: 4px;
        border:1px solid #ddd;
        margin-top: 20px;
        margin-left: 50px;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        background-clip: padding-box;
        opacity: 0.97;
        filter: alpha(opacity=97);
    }
    div.bhoechie-tab-menu{
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a .glyphicon,
    div.bhoechie-tab-menu div.list-group>a .fa {
        color: #5A55A3;
    }
    div.bhoechie-tab-menu div.list-group>a:first-child{
        border-top-right-radius: 0;
        -moz-border-top-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a:last-child{
        border-bottom-right-radius: 0;
        -moz-border-bottom-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a.active,
    div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
    div.bhoechie-tab-menu div.list-group>a.active .fa{
        background-color: #5A55A3;
        background-image: #5A55A3;
        color: #ffffff;
    }
    div.bhoechie-tab-menu div.list-group>a.active:after{
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        margin-top: -13px;
        border-left: 0;
        border-bottom: 13px solid transparent;
        border-top: 13px solid transparent;
        border-left: 10px solid #5A55A3;
    }

    div.bhoechie-tab-content{
        background-color: #ffffff;
        /* border: 1px solid #eeeeee; */
        padding-left: 20px;
        padding-top: 10px;
    }

    div.bhoechie-tab div.bhoechie-tab-content:not(.active){
        display: none;
    }
    .edit_descript{
        background-color: transparent;
        border-color: transparent;
    }
</style>
<script>
    $(document).ready(function () {
        $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
    });
</script>
<#--content_fin--#>