$(function ()
{
    $('#form').submit(function (e)
    {
        e.preventDefault();
        $.ajax({
            url: 'ValidateLogin',
            type: 'POST',
            data: {
                cc: $('#cc').val(),
                mail: $('#mail').val()
            },
            success: function () {
                Command: toastr["error"]("Se esta verificando que los datos coincidan. En caso de aprobarse la validación, a su correo debe estar llegando un correo con una contraseña provisional.", "Validando")
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-center",
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
        })
    });
});