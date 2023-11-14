function postAjax(method, ruta, params, selector_dest) {
    var xhr = new XMLHttpRequest();

    // Muestra el spinner
    var spinnerHtml = '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>';
    if(selector_dest != "") document.querySelector(selector_dest).innerHTML = spinnerHtml;

    // Formatea correctamente los datos para enviarlos como formulario
    var formData = new FormData();
    for (var key in params) {
        formData.append(key, params[key]);
    }

    // Especificar el tipo de solicitud y la URL a la que se enviarán los datos
    xhr.open(method, ruta, true);

    // Definir la función de devolución de llamada
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // La solicitud ha sido completada y la respuesta está lista
            // Aquí puedes manejar la respuesta del servidor

            var respuestaHtml = xhr.responseText;

            // Puedes hacer algo con la respuesta HTML, por ejemplo, insertarla en un elemento
            if(selector_dest != "") document.querySelector(selector_dest).innerHTML = respuestaHtml;

            //console.log(xhr.responseText);
        }
    };
    xhr.send(formData);
}