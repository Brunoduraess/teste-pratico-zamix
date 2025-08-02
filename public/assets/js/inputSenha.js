var senha = $('#senha');
var show = $("#show");
var hide = $("#hide");
var confirma =  $('#confirma');
var showConfirma = $("#showConfirma");
var hideConfirma = $("#hideConfirma");

show.mousedown(function () {
    senha.attr("type", "text");
    $('#hide').show();
    $('#show').hide();
});

show.mouseenter(function () {
    senha.attr("type", "password");
});

hide.mousedown(function () {
    senha.attr("type", "password");
    $('#hide').hide();
    $('#show').show();
});

showConfirma.mousedown(function () {
    confirma.attr("type", "text");
    $('#hideConfirma').show();
    $('#showConfirma').hide();
});


showConfirma.mouseenter(function () {
    confirma.attr("type", "password");
});

hideConfirma.mousedown(function () {
    confirma.attr("type", "password");
    $('#hideConfirma').hide();
    $('#showConfirma').show();
});

