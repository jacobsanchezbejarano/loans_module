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
    if(isset($_POST['crearNuevoPrestamo'])) {
        drawModalNuevoPrestamo();
    }
    
    if(isset($_POST['editarPrestamo'])) {
        drawModalEditarPrestamo($_POST['id_prestamo']);
    }

    if(isset($_POST['eliminarPrestamo'])) {
        eliminarPrestamo($_POST['id_prestamo']);
    }

    $accion = @$_GET['accion'];

    if($accion == 'insertarPrestamo') {
        $Prestamo = new Prestamo();
        // Obtener los datos del formulario o la solicitud
        $codPers = $_POST['codPers'] ?? '';
        $fechaInicio = $_POST['fechaInicio'] ?? '';
        $deudaInicial = $_POST['deudaInicial'] ?? '';
        $montoCuota = $_POST['montoCuota'] ?? '';
        $tipoPlanPagos = $_POST['tipoPlanPagos'] ?? '';

        // Llamar al método insertarPrestamo
        $Prestamo->insertarPrestamo($codPers, $fechaInicio, $deudaInicial, $montoCuota, $tipoPlanPagos);

        // Puedes enviar una respuesta al cliente si es necesario
        echo 'Loan inserted successfully';
    }


    if($accion == 'actualizarPrestamo') {
        $Prestamo = new Prestamo();
        $idPrestamo = $_POST['idPrestamo'];

        $Prestamo->cargarDatosPrestamo($idPrestamo);

        $fechaInicio = $_POST['fechaInicio'] ?? '';
        $deudaInicial = $_POST['deudaInicial'] ?? '';
        $montoCuota = $_POST['montoCuota'] ?? '';
        $tipoPlanPagos = $_POST['tipoPlanPagos'] ?? '';

        $Prestamo->setFechaInicio($fechaInicio);
        $Prestamo->setDeudaInicial($deudaInicial);
        $Prestamo->setMontoCuota($montoCuota);
        $Prestamo->setTipoPlanPagos($tipoPlanPagos);

        $Prestamo->actualizarPrestamoEnBD();

        echo 'Loan updated successfully';

    }

    if($accion == 'eliminarPrestamoConfirmado') {
        $Prestamo = new Prestamo();
        $id_prestamo = $_POST['id_prestamo'];
        $Prestamo->cargarDatosPrestamo($id_prestamo);

        $Prestamo->eliminarPrestamo();

        echo 'Loan deleted successfully';
    }
    
}


function drawModalNuevoPrestamo() {

    $options = '';

    $ajax_search = ajax_search("search_pers(this.value)","show_result_pers","form-control","");
    
    $html = '

    
    <div class="modal-dialog">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Loan</h4>
            </div>
            <div class="modal-body">
                <!-- Aquí coloca los campos del formulario, por ejemplo, un campo de texto para el nombre del staff y un campo de selección (select) para el código del personal (cod_pers) -->
                <form id="nuevoPrestamo">
                    <div class="form-group">
                        <label for="codPers">Select staff:</label>
                        '.$ajax_search.'
                    </div>
                    <div class="form-group">
                        <label for="fechaInicio">Start Date:</label>
                        <input type="date" class="form-control" id="fechaInicio">
                    </div>
                    <div class="form-group">
                        <label for="deudaInicial">Starting loan:</label>
                        <input type="number" class="form-control" id="deudaInicial" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="montoCuota">Loan Payment:</label>
                        <input type="text" class="form-control" id="montoCuota" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="tipoPlanPagos">Tipo de Plan de Pagos:</label>
                        <select class="form-control" id="tipoPlanPagos">
                            <option value="Weekly">Semanal</option>
                            <option value="Biweekly">Biweekly</option>
                            <option value="Monthly">Monthly</option>
                        </select>
                    </div>

                    <!-- Agrega otros campos según sea necesario -->

                    <!-- Botón para enviar el formulario -->
                    <button type="button" onclick="insertarPrestamo()" class="btn btn-primary">Save Loan</button>
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


function drawModalEditarPrestamo($id_prestamo) {

        $Prestamo = new Prestamo();
        $Prestamo->cargarDatosPrestamo($id_prestamo);
        // Simula datos de personal (puedes reemplazar esto con datos reales de tu base de datos)
        
        //$ajax_search = ajax_search("search_pers(this.value)","show_result_pers","form-control","");
    
        // Crea el contenido del modal
        $html = '
        <div class="modal-dialog">
            <!-- Contenido del modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Loan</h4>
                </div>
                <div class="modal-body">
                    <!-- Aquí coloca los campos del formulario, por ejemplo, un campo de texto para el nombre del staff y un campo de selección (select) para el código del personal (cod_pers) -->
                    <form id="editarPrestamo">
                        
                        <div class="form-group">
                            <label for="fechaInicio">Start date:</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" value="'.$Prestamo->getFechaInicio().'">
                        </div>
                        <div class="form-group">
                            <label for="deudaInicial">Starting Loan:</label>
                            <input type="number" class="form-control" id="deudaInicial" name="deudaInicial" placeholder="" value="'.$Prestamo->getDeudaInicial().'">
                        </div>
                        <div class="form-group">
                            <label for="montoCuota">Loan Payment:</label>
                            <input type="text" class="form-control" id="montoCuota" name="montoCuota" placeholder="Monto de la Cuota" value="'.$Prestamo->getMontoCuota().'">
                        </div>
    
                        <div class="form-group">
                            <label for="tipoPlanPagos">Payment Type:</label>
                            <select class="form-control" id="tipoPlanPagos" name="tipoPlanPagos">
                                <option value="Weekly" '.(($Prestamo->getTipoPlanPagos() == "Weekly") ? 'selected' : '').'>Weekly</option>
                                <option value="Biweekly" '.(($Prestamo->getTipoPlanPagos() == "Biweekly") ? 'selected' : '').'>Biweekly</option>
                                <option value="Monthly" '.(($Prestamo->getTipoPlanPagos() == "Monthly") ? 'selected' : '').'>Monthly</option>
                            </select>
                        </div>
    
                        <!-- Agrega otros campos según sea necesario -->
    
                        <!-- Botón para enviar el formulario -->
                        <button type="button" onclick="actualizarPrestamo('.$Prestamo->getId().')" class="btn btn-primary" data-toggle="modal" data-target="#div_modal">Save Changes</button>
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


function eliminarPrestamo($prestamo_id) {
    echo "
    <div class='modal-dialog' role='document'>
        <div class='modal-content result-delete'>
            <div class='modal-header'>
                <h5 class='modal-title' id='eliminarModalLabel'>Confirmation</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                Are you sure to delete this loan?
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                <button type='button' class='btn btn-danger' onclick='eliminarPrestamoConfirmado(".$prestamo_id.")'>Eliminar</button>
            </div>
        </div>
    </div>
    ";
}