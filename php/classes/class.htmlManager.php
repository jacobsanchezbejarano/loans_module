<?php

class HtmlManager {
    private $Prestamos;

    public function __construct() {
        $this->Prestamos = new Prestamos();
    }

    public function buildHTML() {
        $html = "";
        $html .= $this->generarEncabezado('Loans');
        $html .= $this->generarNavbar();
        $html .= $this->generarInicioContainer('Loan View');
        $html .= $this->generarTablaPrestamos();
        $html .= $this->generarFinTabla();
        $html .= $this->generarModales();
        $html .= $this->generarScriptJs();
        $html .= $this->generarFinHtml();

        return $html;
    }

    public function generarEncabezado($titulo) {
        $html = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>
                <link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css' rel='stylesheet' />

                <link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css' rel='stylesheet' />
                <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js'></script>

                <link rel='stylesheet' href='styles/prestamos.css'>
                <link rel='stylesheet' href='styles/ajaxSearchStyles.css'>
                <title>$titulo</title>
            </head>
            <body>
        ";

        return $html;
    }

    public function generarNavbar() {
        $html = "
            <nav class='navbar navbar-default'>
                <div class='container'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Loan and Payment's Management</a>
                    </div>
                </div>
            </nav>
        ";

        return $html;
    }

    public function generarInicioContainer($panelTitulo) {
        $html = "
            <div class='container'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>$panelTitulo</h3>
                    </div>
                    <div class='panel-body'>
        ";

        return $html;
    }

    public function generarFinContainer() {
        $html = "
                    </div>
                </div>
            </div>
        ";

        return $html;
    }

    public function generarTablaPrestamos() {
        $html = "
        <button class='btn btn-primary' data-toggle='modal' onclick='crearNuevoPrestamo()' data-target='#agregarPrestamoModal'>
            Add New Loan <span class='glyphicon glyphicon-plus'></span>
        </button>

            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Starting Date</th>
                        <th>Starting Loan</th>
                        <th>Accumulated Payments</th>
                        <th>Pending Amount</th>
                        <th>Payment Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Filas de datos -->
                    <!-- Cada fila representa un préstamo -->
        ";

        // Iterar sobre cada préstamo y generar una fila en la tabla
        foreach ($this->Prestamos->obtenerTodosLosPrestamos() as $prestamo) {
            $html .= "
                <tr>
                    <td>{$prestamo->getNombreStaff()}</td>
                    <td>{$prestamo->getFechaInicio()}</td>
                    <td>{$prestamo->getDeudaInicial()}</td>
                    <td>{$prestamo->getSumatoriaPagos()}</td>
                    <td>{$prestamo->getSaldoPendiente()}</td>
                    <td>{$prestamo->getTipoPlanPagos()}</td>
                    <td>
                    <!-- Botón para Ver Más con llamada a la función verPagosDeuda -->
                        <button class='btn btn-info btn-sm' onclick='verPagosDeuda(".$prestamo->getId().")' data-toggle='modal' data-target='#verMasModal'><i class='fa fa-eye'></i> </button>                 
                        <button class='btn btn-warning btn-sm'onclick='editarPrestamo(".$prestamo->getId().")' data-toggle='modal' data-target='#generarModalEditar'><i class='fa fa-pencil'></i></button>
                        <button class='btn btn-success btn-sm'onclick='modalRegistrarPago(".$prestamo->getId().")' data-toggle='modal' data-target='#registrarPagoModal'><i class='fas fa-money-check'></i></button>
                        <button class='btn btn-danger btn-sm' onclick='eliminarPrestamo(".$prestamo->getId().")' data-toggle='modal' data-target='#eliminarModal'><i class='fas fa-trash-alt'></i></button>
                    </td>
                </tr>
            ";
        }

        return $html;
    }


    public function generarFinTabla() {
        $html = "
                </tbody>
            </table>
        ";

        return $html;
    }

    public function generarModales() {
        $html = '
        <div id="agregarPrestamoModal" class="modal fade" role="dialog"></div>
        <div id="verMasModal" class="modal fade" role="dialog"></div>
        <div id="generarModalEditar" tabindex="-1" class="modal fade" role="dialog"></div>
        <div id="registrarPagoModal" class="modal fade" role="dialog"></div>
        <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true"></div>
        <div id="div_modal" class="modal fade" role="dialog"></div>
        ';
        return $html;
    }

    public function generarScriptJs() {
        $html = "
            <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
            <script src='js/index.js'></script>
            <script src='js/ajax_search.js'></script>
            <script src='js/prestamos_module/prestamos.js'></script>
            <script src='js/prestamos_module/pagos.js'></script>
            <script src='js/staff.js'></script>
            <script>
        ";

        return $html;
    }

    public function generarFinHtml() {
        $html = '
            </body>
            </html>
        ';

        return $html;
    }
}

?>
