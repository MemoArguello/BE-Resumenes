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
// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Obtener elementos del modal
    const modal = document.getElementById('clientModal');
    const closeBtn = document.querySelector('.modal-close');
    
    // Función para mostrar el modal y detalles del cliente
    window.showClientDetails = function(client) {
        // Actualizar el contenido del modal
        document.getElementById('modal-carpeta').textContent = client.n_carpeta;
        document.getElementById('modal-cliente-desde').textContent = formatDate(client.cliente_desde);
        document.getElementById('modal-ruc').textContent = client.ruc;
        document.getElementById('modal-dv').textContent = client.dv;
        document.getElementById('modal-nombre').textContent = client.nombre;
        document.getElementById('modal-fantasia').textContent = client.nombre_fantasia;
        document.getElementById('modal-telefono').textContent = client.telefono;
        document.getElementById('modal-direccion').textContent = client.direccion;
        document.getElementById('modal-vencimiento').textContent = formatDate(client.vencimiento);
        
        // Mostrar el modal
        modal.style.display = 'block';
    };
    
    // Función para cerrar el modal
    function closeModal() {
        modal.style.display = 'none';
    }
    
    // Función para formatear fechas
    function formatDate(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        return date.toLocaleDateString('es-PY');
    }
    
    // Event listener para el botón de cerrar
    closeBtn.addEventListener('click', closeModal);
    
    // Event listener para cerrar al hacer clic fuera del modal
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });
    
    // Event listener para cerrar con la tecla ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.style.display === 'block') {
            closeModal();
        }
    });
});

// Función para mostrar el modal de edición
function showEditModal(client) {
    document.getElementById('edit-id').value = client.id;
    document.getElementById('edit-carpeta').value = client.n_carpeta;
    document.getElementById('edit-cliente-desde').value = client.cliente_desde;
    document.getElementById('edit-ruc').value = client.ruc;
    document.getElementById('edit-dv').value = client.dv;
    document.getElementById('edit-nombre').value = client.nombre;
    document.getElementById('edit-fantasia').value = client.nombre_fantasia;
    document.getElementById('edit-telefono').value = client.telefono;
    document.getElementById('edit-direccion').value = client.direccion;
    document.getElementById('edit-vencimiento').value = client.vencimiento;
    
    document.getElementById('editModal').style.display = 'block';
}

// Función para cerrar el modal de edición
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target == modal) {
        closeEditModal();
    }
}