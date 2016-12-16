$(function ()
{
    TiposPeticiones();
    nuevotipopeticion();
    VerEncabezado();
    tin('#encabezado_format');
});
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
            if (method == "spellcheck") {
                var suggestions = {};
                for (var i = 0; i < words.length; i++) {
                    suggestions[words[i]] = ["First", "second"];
                }

                callback(suggestions);
            }
        }
    });
}
function setEncabezado()
{
    loadingstart();
    console.log(tinyMCE.get('encabezado_format').getContent());
    $.ajax({url: 'Ajax/AjaxSetValueConfig.php',
        type: 'POST',
        data: {name: 'formato_encabezado', value: tinyMCE.get('encabezado_format').getContent()},
        success: function (data) {
            $('textarea#encabezado_format').val(data.value);
            VerEncabezado();
        },
        complete: function (jqXHR, textStatus) {
            loadingstop();
        }});
}
function VerEncabezado()
{
    $.ajax({url: 'Ajax/AjaxNameConfig.php',
        type: 'POST',
        data: {name: 'formato_encabezado'},
        dataType: 'json',
        success: function (data) {
            $('textarea#encabezado_format').val(data.value);
        }});
}
function TiposPeticiones()
{
    $.ajax({url: 'Ajax/AjaxViewTipoPeticion.php',
        type: 'POST',
        success: function (data) {
            $('#data_peticiones_tipo').html(data);
        }});
}
function nuevotipopeticion()
{
    $('#new_peticion').click(function ()
    {
        $.ajax({url: 'Ajax/AjaxNewTipoPeticion.php',
            data: {nombre_tipo_peticion: $('#nombre_tipo_peticion').val()},
            type: 'POST',
            success: function (data) {
                TiposPeticiones();
            },
            complete: function (jqXHR, textStatus) {
                loadingstop();
            }});
    });
}
function editar(id)
{
    loadingstart();
    $.ajax({url: 'Ajax/AjaxSaveTipoPeticion.php',
        data: {
            nombre_tipo_peticion: $('#edit_tipo_' + id).val(),
            id: id
        },
        type: 'POST',
        success: function () {
            TiposPeticiones();
        },
        complete: function () {
            loadingstop();
        }});
}