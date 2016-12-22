<?php
include_once '../../../controller/form.php';
$form->ruta       = '../../../view/plantillas';
$form->plantilla  = 'reportes.php';
$form->parametros = array('titulo' => 'Ingreso de peticiones', 'css' => array('css/source/custom-small-screens.css'),'js'=>array('js/source/tinymce.js'));
$form->create(__FILE__);
?>
<#--content_ini--#>
<script>
    function tin(input)
    {
        tinymce.init({
            selector: "textarea" + input,
            theme: "modern",
            height: 500,
            plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor importcss"
            ],
            file_browser_callback: function elFinderBrowser(field_name, url, type, win)
            {
                tinymce.activeEditor.windowManager.open({
                    file: 'subir_archivos', // use an absolute path!
                    title: "Insertar fichero",
                    width: 900,
                    height: 519,
                    resizable: 'yes'
                }, {
                    setUrl: function (url) {
                        win.document.getElementById(field_name).value = url;
                    }
                });
            },
            content_css: "css/development.css",
            add_unload_trigger: false,
            toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage ",
            image_advtab: true,
            language: 'es',
            style_formats: [
                {title: 'Bold text', format: 'h1'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ],
            template_replace_values: {
                username: "Jack Black"
            },
            template_preview_replace_values: {
                username: "Preview user name"
            },
            templates: [
                {title: 'Some title 1', description: 'Some desc 1', content: '<strong class="red">My content: {$username}</strong>'},
                {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
            ],
            setup: function (ed) {
                ed.addButton('custompanelbutton', {
                    type: 'panelbutton',
                    text: 'Panel',
                    panel: {
                        type: 'form',
                        items: [
                            {type: 'button', text: 'Ok'},
                            {type: 'button', text: 'Cancel'}
                        ]
                    }
                });
                ed.addButton('textbutton', {
                    type: 'button',
                    text: 'Text'
                });
            },
            spellchecker_callback: function (method, words, callback) {
                if (method === "spellcheck") {
                    var suggestions = {};
                    for (var i = 0; i < words.length; i++) {
                        suggestions[words[i]] = ["First", "second"];
                    }

                    callback(suggestions);
                }
            }
        });
    }
    $(function ()
    {
        tin('#encabezado_admin');
        $('#enviar').click(function ()
        {
            $.ajax({
                url: 'Ajax/AjaxGuardarCab',
                type: 'POST',
                data: {value: tinyMCE.get('encabezado_admin').getContent()},
                success: function (data) {
                    alert('dato guardado');
                }
            });
        });
    });
</script>
<div class="panel panel-success">
    <div class="panel-heading">
        Editar encabezado
    </div>
    <div class="panel-body">
        <textarea class="form form-control" id="encabezado_admin" style="height: 214px !important;"><?php
            include_once '../../../model/modelConfig.php';
            $conf             = new modelConfig();
            $data             = $conf->VerValue('formato_admin');
            echo $data;
            ?></textarea>
    </div>
    <div class="panel-footer">
        <div class="container-fluid">
            <div class="col-xs-12">
                <button id="enviar" class="form form-control btn btn-primary"><i class="glyphicon glyphicon-floppy-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<#--content_fin--#>