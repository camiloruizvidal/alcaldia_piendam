function submit_form()
{
    $('#form').submit(function (e)
    {
        e.preventDefault();
        loadingstart();
        $.ajax({
            url: 'Ajax/AjaxLogin.php',
            data: {login: $('#UserName').val(), password: $('#Passwod').val()},
            type: 'POST',
            dataType: 'json',
            success: function (data)
            {
                if (data.SiValida)
                {
                    window.location.href = data.url;
                } else
                {
                    $('.log-status').addClass('wrong-entry');
                    $('.alert').fadeIn(500);
                    setTimeout("$('.alert').fadeOut(1500);", 3000);
                }
            },
            complete: function (jqXHR, textStatus) {
                loadingstop();
            }
        });
    });
}
$(document).ready(function ()
{
    submit_form();
});
