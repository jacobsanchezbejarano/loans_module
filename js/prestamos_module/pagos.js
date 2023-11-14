//Ruta por default
const ruta_pagos = "./php/ajax/pagos.php";
var method = "POST"; 

// Función para registrar pagos
function registrarPago() {
    // Implementa la lógica para registrar el pago en la base de datos o en tu aplicación
    alert("Pago registrado con éxito.");
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