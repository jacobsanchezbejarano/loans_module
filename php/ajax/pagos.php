<?php

include '../config.php';
//Include classes
include '../classes/class.connection.php';
include '../classes/class.prestamos.php';
include '../classes/class.pagos.php';

//Include functions
include '../functions/ajax_search.php';

$valid_request = true;

if($valid_request) {
    if(isset($_POST['verPagosDeuda'])) {
        drawModal($_POST['id_prestamo']);
    }

    if(isset($_POST['editarPrestamo'])) {
        drawModal($_POST['id_prestamo']);
    }

    if(isset($_POST['modalRegistrarPago'])) {
        modalRegistrarPago($_POST['id_prestamo']);
    }

    $accion = @$_GET['accion'];

    if ($accion == 'registrarPago') {
        // Obtener los datos del formulario o la solicitud
        $id_prestamo = $_POST['id_prestamo'] ?? '';
        $fechaPago = $_POST['fechaPago'] ?? '';
        $montoPagado = $_POST['montoPagado'] ?? '';
        $tipoTransaccion = $_POST['tipoTransaccion'] ?? '';
    
        // Llamar al método insertarPago
        // Asegúrate de tener la lógica adecuada en el método insertarPago en tu clase Prestamo
        $Pago = new Pago($id_prestamo, $fechaPago, $montoPagado, $tipoTransaccion, '');
        $Pago->insertarPago();
        
        // Puedes enviar una respuesta al cliente si es necesario
        echo 'Payment recorded successfully';
    }
    
}

function drawModal($id_prestamo) {
    // Obtener información del préstamo y sus pagos desde la base de datos o donde sea necesario
    
    $Prestamo = new Prestamo(); // Reemplaza con la lógica real
    $Prestamo->cargarDatosPrestamo($id_prestamo); // Reemplaza con la lógica real
    $Pagos = new Pagos();
    $Pagos->cargarPagosPorPrestamo($id_prestamo);

    $html = '
    <div class="modal-dialog">
    <!-- Contenido del modal -->
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment History</h4>
        </div>
        <div class="modal-body">
        <!-- Tabla de Pagos Realizados -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Date</th>
                <th>Payment Cod.</th>
                <th>Amount</th>
                <th>Payment Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>';

    // Iterar sobre los pagos del préstamo y construir las filas de la tabla
    $x = 0;
    foreach ($Pagos->obtenerPagosPorPrestamo() as $pago) {
        $x++;
        $html .= '
            <tr>
                <td>' . $pago->getFechaPago() . '</td>
                <td>' . $pago->getCodMaster() . '</td>
                <td contenteditable="true">' . $pago->getMontoPagado() . '</td>
                <td>' . $pago->getTipoTransaccion() . '</td>
                <td></td>
            </tr>';
    }
    $empty = "";
    
    if($x == 0) $empty .= 'There are not payments recorded.';

    // Cerrar la parte del cuerpo y agregar el pie del modal
    $html .= '
            </tbody>
        </table>
        '.$empty.'
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
    ';

    echo $html;
}

function modalRegistrarPago($id_prestamo) {
    $html = '
    <div class="modal-dialog">
    <!-- Contenido del modal -->
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Record Payment</h4>
        </div>
        <div class="modal-body">
        <!-- Formulario para registrar pagos -->
        <form>
            <div class="form-group">
            <label for="fechaPago">Payment date:</label>
            <input type="date" class="form-control" id="fechaPago" required>
            </div>
            <div class="form-group">
            <label for="montoPagado">Amount:</label>
            <input type="number" class="form-control" id="montoPagado" required>
            </div>
            <div class="form-group">
            <label for="tipoTransaccion">Payment type:</label>
            <select class="form-control" id="tipoTransaccion">
                <option value="descuento">Discount before services payment</option>
                <option value="cobroDirecto">Direct payment</option>
            </select>
            </div>
            <!-- Otros campos según sea necesario -->
            <button type="button" class="btn btn-success" onclick="registrarPago('.$id_prestamo.')">Save Payment</button>
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
    ';

    echo $html;
}
