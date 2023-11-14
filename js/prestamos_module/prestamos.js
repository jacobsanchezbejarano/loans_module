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

    //console.log(params);

    postAjax(method, ruta_prestamos + '?accion=insertarPrestamo', params, '');
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

    console.log(params);

    postAjax(method, ruta_prestamos + '?accion=actualizarPrestamo', params, '');
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

