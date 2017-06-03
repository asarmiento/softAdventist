/**
 * Created by anwarsarmiento on 2/6/17.
 */

$(document).ready(function() {
    var server = "/";

    var ajaxForm = function (url, type, data, msg, school) {
        var message;
        var path = server + url;
        if (msg) {
            message = msg
        } else {
            if (type == 'post') {
                message = 'Registrando Datos';
            } else {
                message = 'Actualizando Registros';
            }
        }
        if (school) {
            path = server + window.location.pathname.split('/')[1] + '/' + window.location.pathname.split('/')[2] + ('/') + url;
        }
        return $.ajax({
            url: path,
            type: type,
            data: {data: JSON.stringify(data)},
            datatype: 'json',
            beforeSend: function () {
                loadingUI(message, 'img');
            },
            error: function (xhr, status, error) {
                $.unblockUI();
                if (xhr.status == 401) {
                    bootbox.alert("<p class='red'>No estas registrado en la aplicación.</p>", function (response) {
                        location.reload();
                    });
                } else {
                    bootbox.alert("<p class='red'>No se pueden grabar los datos.</p>");
                }
            }
        });
    };

    var loadingUI = function (message, img) {
        if (img) {
            var msg = '<h2><img style="margin-right: 30px" src="http://jaacscr.contadventista.org/public/images/spiffygif.gif" >' + message + '</h2>';
        } else {
            var msg = '<h2>' + message + '</h2>';
        }
        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: 0.5,
                color: '#fff'
            }, message: msg
        });
    };
    var box;
    //retornamos mensajes de exito por ajax
    var messageAjax = function (data, no_bootbox) {
        //console.log(data.errors);
        $.unblockUI();
        if (data.success) {
            if (data.message.redirect) {
                window.location.href = data.message.href;
            } else {
                if (!no_bootbox) {
                    bootbox.alert('<p class="success-ajax">' + data.message + '</p>', function () {
                        location.reload();
                    });
                }
            }
        }
        else {
            messageErrorAjax(data);
        }
    };
    //retornamos mensajes de error por ajax
    var messageErrorAjax = function (data) {
        $.unblockUI();
        var errors = data.errors;
        var error = "";
        if ($.type(errors) === 'string') {
            error = data.errors;
        } else {
            for (var element in errors) {
                if (errors.hasOwnProperty(element)) {
                    error += errors[element] + '<br>';
                }
            }
        }
        bootbox.alert('<p class="error-ajax">' + error + '</p>');
    };
    //setup Ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var data = {};

    $(document).off('click', '#saveMembers');
    $(document).on('click', '#saveMembers', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var auth = $(this).data('auth');
        url =  'tesoreria/save-' + url;
        data.charter        = $('#charter').val();
        data.name           = $('#name').val();
        data.last           = $('#last').val();
        data.bautizmoDate   = $('#bautizmoDate').val();
        data.birthdate      = $('#birthdate').val();
        data.phone          = $('#phone').val();
        data.cell           = $('#cell').val();
        data.email          = $('#email').val();

        ajaxForm(url,'post',data)
            .done( function (data) {
                messageAjax(data);
            });
    });

});

