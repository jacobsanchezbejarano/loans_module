function postAjax(method, ruta, params, selector_dest) {
    return new Promise(function(resolve, reject) {
        var xhr = new XMLHttpRequest();

        // Muestra el spinner
        var spinnerHtml = '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>';
        if (selector_dest !== "") document.querySelector(selector_dest).innerHTML = spinnerHtml;

        // Formatea correctamente los datos para enviarlos como formulario
        var formData = new FormData();
        for (var key in params) {
            formData.append(key, params[key]);
        }

        // Especificar el tipo de solicitud y la URL a la que se enviarán los datos
        xhr.open(method, ruta, true);

        // Definir la función de devolución de llamada
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                // La solicitud ha sido completada
                var respuestaHtml = xhr.responseText;

                if (xhr.status == 200) {
                    // La solicitud fue exitosa
                    if (selector_dest !== "") document.querySelector(selector_dest).innerHTML = respuestaHtml;
                    resolve(respuestaHtml);
                } else {
                    // La solicitud falló
                    reject('Error en la solicitud');
                }
            }
        };
        xhr.send(formData);
    });
}