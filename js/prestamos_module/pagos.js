//Ruta por default
const ruta_pagos = "php/ajax/pagos.php";
var method = "POST"; 

// Función para registrar pagos
function registrarPago(id_prestamo) {
    // Obtener los valores del formulario modal
    var fechaPago = $('#fechaPago').val();
    var montoPagado = $('#montoPagado').val();
    var tipoTransaccion = $('#tipoTransaccion').val();

    var params = {
        id_prestamo: id_prestamo,
        fechaPago: fechaPago,
        montoPagado: montoPagado,
        tipoTransaccion: tipoTransaccion
        // Agrega otros campos según sea necesario
    };

    postAjax(method, ruta_pagos + '?accion=registrarPago', params, '').then(function(respuestaHtml) {
        // Hacer algo con la respuesta HTML en caso de éxito
        cerrar_modals();
        document.querySelector('.modal-backdrop').remove();
        document.querySelector('#div_modal').innerHTML = `
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='actualizarPrestamo'>Payment recorded</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    ${respuestaHtml}
                </div>
                <div class='modal-footer'>
                </div>
            </div>
        `;
    })
    .then(function() {
        //location.reload(); // Recargar la página después de la operación
    })
    .catch(function(error) {
        // Manejar el error en caso de fallo
        console.error('Error:', error);
    });
}


function verPagosDeuda(id_Prestamo) {
    //get data with ajax
    // Crear el cuerpo de la solicitud
    var selector_dest = "#verMasModal";

    var params = {
        verPagosDeuda: true,
        id_prestamo: id_Prestamo
    };
    
    postAjax(method,ruta_pagos,params,selector_dest);
}

function modalRegistrarPago(id_Prestamo) {
    //get data with ajax
    // Crear el cuerpo de la solicitud
    var selector_dest = "#registrarPagoModal";

    var params = {
        modalRegistrarPago: true,
        id_prestamo: id_Prestamo
    };
    
    postAjax(method,ruta_pagos,params,selector_dest);
}