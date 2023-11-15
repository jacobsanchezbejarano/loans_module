//Ruta por default
const ruta_prestamos = "php/ajax/prestamos.php";

var method = "POST"; 

function insertarPrestamo() {
    var codPers = $('#cod_pers').val();
    var fechaInicio = $('#fechaInicio').val();
    var deudaInicial = $('#deudaInicial').val();
    var montoCuota = $('#montoCuota').val();
    var tipoPlanPagos = $('#tipoPlanPagos').val();

    var params = {
        codPers: codPers,
        fechaInicio: fechaInicio,
        deudaInicial: deudaInicial,
        montoCuota: montoCuota,
        tipoPlanPagos: tipoPlanPagos
    };

    postAjax(method, ruta_prestamos + '?accion=insertarPrestamo', params, '').then(function(respuestaHtml) {
        // Hacer algo con la respuesta HTML en caso de éxito
        cerrar_modals();
        document.querySelector('.modal-backdrop').remove();
        document.querySelector('#div_modal').innerHTML = `
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='actualizarPrestamo'>Updated</h5>
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
        //setTimeout(function() {
            location.reload();
        // }, 1000);
    });
}

function actualizarPrestamo(idPrestamo) {
    var fechaInicio = $('#fechaInicio').val();
    var deudaInicial = $('#deudaInicial').val();
    var montoCuota = $('#montoCuota').val();
    var tipoPlanPagos = $('#tipoPlanPagos').val();

    var params = {
        idPrestamo: idPrestamo,
        fechaInicio: fechaInicio,
        deudaInicial: deudaInicial,
        montoCuota: montoCuota,
        tipoPlanPagos: tipoPlanPagos
    };

    postAjax(method, ruta_prestamos + '?accion=actualizarPrestamo', params, '')
    .then(function(respuestaHtml) {
        // Hacer algo con la respuesta HTML en caso de éxito
        cerrar_modals();
        document.querySelector('.modal-backdrop').remove();
        document.querySelector('#div_modal').innerHTML = `
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='actualizarPrestamo'>Updated</h5>
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
        //setTimeout(function() {
            location.reload();
        // }, 1000);
    })
    .catch(function(error) {
        // Manejar el error en caso de fallo
        console.error('Error:', error);
    });
}

function crearNuevoPrestamo() {
    //get data with ajax
    // Crear el cuerpo de la solicitud
    cerrar_modals();
    var selector_dest = "#agregarPrestamoModal";

    var params = {
        crearNuevoPrestamo: true
    };
    
    postAjax(method,ruta_prestamos,params,selector_dest);
}

function editarPrestamo(id_Prestamo) {
    //get data with ajax
    // Crear el cuerpo de la solicitud
    cerrar_modals();
    var selector_dest = "#generarModalEditar";

    var params = {
        editarPrestamo: true,
        id_prestamo: id_Prestamo
    };
    
    postAjax(method,ruta_prestamos,params,selector_dest);
}

function eliminarPrestamo(id_Prestamo) {
    //get data with ajax
    // Crear el cuerpo de la solicitud
    var selector_dest = "#eliminarModal";

    var params = {
        eliminarPrestamo: true,
        id_prestamo: id_Prestamo
    };
    
    postAjax(method,ruta_prestamos,params,selector_dest);
}

function eliminarPrestamoConfirmado(id_prestamo) {
    //get data with ajax
    // Crear el cuerpo de la solicitud
    var selector_dest = ".result-delete";

    var params = {
        id_prestamo: id_prestamo
    };
    
    postAjax(method,ruta_prestamos + '?accion=eliminarPrestamoConfirmado',params,selector_dest).then(function(respuestaHtml) {
        // Hacer algo con la respuesta HTML en caso de éxito
        cerrar_modals();
        document.querySelector('.modal-backdrop').remove();
        document.querySelector('#div_modal').innerHTML = `
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='prestamoEliminado'>Updated</h5>
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
        //setTimeout(function() {
            location.reload();
        //}, 1000);
    })
    .catch(function(error) {
        // Manejar el error en caso de fallo
        console.error('Error:', error);
    });
}

