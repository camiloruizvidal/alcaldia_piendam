<?php
@session_start();
include_once '../../../controller/form.php';
$form->ruta       = '../../../view/plantillas';
$form->plantilla  = 'configuration.php';
$form->parametros = array('titulo' => 'Ingreso de peticiones', 'css' => array('css/source/custom-small-screens.css'));
$form->create(__FILE__);
?>
<#--content_ini--#>

<script>
    $(function ()
    {
        validar();
    });
    function validar()
    {
        $('#editar_usuario').submit(function (e)
        {
            e.preventDefault();
            $.ajax({
                url: 'Ajax/AjaxCambiarDatosUsuario.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (data)
                {
                    if (data.SiValida)
                    {
                        Command: toastr["success"]("Se realizaron los cambios con éxito", "Guardado")
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-left",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    } else
                    {
                        Command: toastr["error"]("No se pudo realizar la asignacion al auxilar", "Error")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-left",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            });
        });
    }
</script>
<div class="container">
    <form id="editar_usuario"> 
        <div class="panel panel-success">
            <div class="panel-heading">
                Datos de usuario
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <div class="col-xs-6">
                        <label>Nombre</label>
                        <input value="<?php echo $_SESSION['nombre']; ?>" class="form form-control" id="nombre" readonly="readonly">
                    </div>
                    <div class="col-xs-6">
                        <label>Apellido</label>
                        <input value="<?php echo $_SESSION['apellido']; ?>" class="form form-control" id="apellido" readonly="readonly">
                    </div>
                    <div class="col-xs-6">
                        <label>Documento</label>
                        <input value="<?php echo $_SESSION['documento']; ?>" class="form form-control" id="documento" readonly="readonly">
                    </div>
                    <div class="col-xs-6">
                        <label>Telefono</label>
                        <input value="<?php echo $_SESSION['telefono']; ?>" required="true" class="form form-control" id="telefono" name="telefono">
                    </div>
                    <div class="col-xs-6">
                        <label>Celular</label>
                        <input value="<?php echo $_SESSION['celular']; ?>" required="true" class="form form-control" id="celular" name="celular">
                    </div>
                    <div class="col-xs-6">
                        <label>Correo</label>
                        <input type="email" value="<?php echo $_SESSION['correo']; ?>" required="true" class="form form-control" id="correo" name="correo">
                    </div>
                    <div class="col-xs-3">
                        <label>Login</label>
                        <input required="true" class="form form-control" id="login" name="login">
                    </div>
                    <div class="col-xs-3">
                        <label>Contraseña anterior</label>
                        <input type="password" required="true" class="form form-control" id="pass_old" name="pass_old">
                    </div>
                    <div class="col-xs-3">
                        <label>Contraseña nueva</label>
                        <input type="password" required="true" class="form form-control" id="pass" name="pass">
                    </div>
                    <div class="col-xs-3">
                        <label>Repita la contraseña nueva</label>
                        <input type="password" required="true" class="form form-control" id="pass2" name="pass2">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="container-fluid">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<#--content_fin--#>