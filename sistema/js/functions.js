$(document).ready(function () {

    //  Actualizar datos de la empresa
    $('#formEmpresa').submit(function (e) {
        /* e.preventDefault(); */
        var intNit = $('#txtRuc').val();
        var intDv = $('#txtDv').val();
        var strNombreEmp = $('#txtNombre').val();
        var strRSocialEmp = $('#txtRSocial').val();
        var intTelEmp = $('#txtTelEmpresa').val();
        var strEmailEmp = $('#txtEmailEmpresa').val();
        var strDirEmp = $('#txtDirEmpresa').val();

        if (intNit == '' || intDv == '' || strNombreEmp == '' || intTelEmp == '' || strEmailEmp == '' || strDirEmp == '') {
            $('.alertFormEmpresa').html('<p style="color: red;">Todos los campos son obligatorios.</p>');
            $('.alertFormEmpresa').slideDown();
            return false;
        }

        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: $('#formEmpresa').serialize(),
            beforeSend: function () {
                $('.alertFormEmrpresa').slideUp();
                $('.alertFormEmrpresa').html('');
                $('#formEmpresa input').attr('disabled", disabled');
            },
            success: function (response) {
                var info = JSON.parse(response);
                if (info.cod == '00') {
                    $('.alertChangePass').html('<p style="color: green;">' + info.msg + '</p>');
                    $('.alertFormEmpresa').slideDown();
                } else {
                    $('.alertFormEmpresa').html('<p style="color: red;">' + info.msg + '</p>');
                }
                $('.alertFormEmpresa').slideDown();
                $('#formEmpresa input').removeAttr('disabled');
            },
            error: function (error) {
            }
        });

    });
});
