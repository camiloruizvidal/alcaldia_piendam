$(function ()
{
    var date = new Date();
    var primerdia = new Date(date.getFullYear(), date.getMonth(), 1);
    var ultimodia = new Date(date.getFullYear(), date.getMonth(), 0);
    var hoydia = new Date();
    $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
    $('.fechaini').datepicker({dateFormat: 'yy-mm-dd'});
    $('.fechafin').datepicker({dateFormat: 'yy-mm-dd'});
    $('.fechahoy').datepicker({dateFormat: 'yy-mm-dd'});
    $('.fechaini').val(primerdia.getFullYear() + '-' + (primerdia.getMonth() + 1) + '-' + primerdia.getDate());
    $('.fechahoy').val(primerdia.getFullYear() + '-' + (primerdia.getMonth() + 1) + '-' + hoydia.getDate());
    $('.fechafin').val(primerdia.getFullYear() + '-' + (primerdia.getMonth() + 1) + '-' + ultimodia.getDate());
});
function getUrlVars()  //Funcion para llamar datos capturar valores url get ejemplo var second = getUrlVars()["name2"];
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}